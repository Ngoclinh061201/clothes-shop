<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\AboutU;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Client\SharedController;


class IntroduceController extends Controller
{
    private $result;

    public function __construct(SharedController $sharedController) {
        if(empty(Cache::get('cate_menu'))){
            Cache::put('cate_menu', $sharedController->getDataMenu());
        }
        $this->result = Cache::get('cate_menu');
    }
    public function index(){
        $about = DB::table('about_us')->latest('created_at')->first();
        $this->result['about'] = $about;
        
        return view('client.pages.introduce.index', ['data' => $this->result]);
    }

    
}
