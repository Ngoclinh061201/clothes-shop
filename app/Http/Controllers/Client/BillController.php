<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Models\City;
use App\Models\District;
use DB;
class BillController extends Controller
{

    private $result;
    public function __construct(SharedController $sharedController) {
        if(empty(Cache::get('cate_menu'))){
            Cache::put('cate_menu', $sharedController->getDataMenu());
        }
        $this->result = Cache::get('cate_menu');
    }

    public function checkout(Request $request){
        $city = City::all();
        $this->result['city'] = $city;
        $total = 0;
        $this->result['cart'] = [];
        if(!empty($request->session()->all()['cart'][Auth::id()])){
            $this->result['cart'] = $request->session()->all()['cart'][Auth::id()];
            foreach ($this->result['cart'] as $value){
                $total += (!empty($value['price_sale'])) ? $value['price_sale'] : $value['price'];
                $total *= $value['quantity'];
            }
        }
        $this->result['total_price'] = number_format($total);
        return view('client.pages.bill.checkout', ['data' => $this->result]);
    }

    public function getDistrictsByCity(Request $request){
        $district = DB::table('district')
            ->where('city_id', '=', $request->code_city)
            ->get();
        return $district;
    }

    public function seedDataCity(){
        $response = Http::get(config('constants.district'));
        $jsonData = $response->object();
        foreach ($jsonData as $key => $value){
            $city = new City();
            $idCity = $key + 1;
            $city->id = $key + 1;
            $city->name = $value->name;
            $city->code_name = $value->codename;
            $city->phone_code = $value->phone_code;
            $city->save();
            foreach ($value->districts as $keyDistrict => $valueDistrict){
                if($valueDistrict->province_code == $value->code){
                    $district = new District();
                    $district->name = $valueDistrict->name;
                    $district->code_name = $valueDistrict->codename;
                    $district->city_id = $idCity;
                    $district->save();
                }
            }
        }
    }

    public function placeOrder(Request $request){
        $bill = new Bills();
        $totalPrice = 0;
        $dataCart = $request->session()->all()['cart'][Auth::id()];
        foreach ($dataCart as $value){
            $totalPrice += (!empty($value['price_sale'])) ? $value['price_sale'] : $value['price'];
            $totalPrice *= $value['quantity'];
        }
//        save bill
        $bill->user_order_id = Auth::id();
        $bill->recipient_name = $request->full_name;
        $bill->city_id = $request->code_city;
        $bill->district_id = $request->district;
        $bill->number_phone = $request->number_phone;
        $bill->address_detail = $request->address_detail;

    }
}


