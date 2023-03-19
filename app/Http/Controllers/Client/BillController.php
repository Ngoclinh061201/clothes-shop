<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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
        $this->result['cart'] = $request->session()->all()['cart'][Auth::id()];
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
}


