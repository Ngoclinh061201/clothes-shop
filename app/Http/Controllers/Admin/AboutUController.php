<?php
namespace App\Http\Controllers\Admin;
use App\Models\AboutU;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class AboutUController extends Controller
{
    public function index(){
        $about = DB::table('about_us') ->latest('created_at')->first();
        return view('admin.pages.about-us.index', compact('about'));
    }   
    public function create()
    {  
        $about = DB::table('about_us')->latest('created_at')->first();
        if(!empty($about)){
            return redirect('about-us')->with('success', 'Available content');
            
        } else {
            return view('admin.pages.about-us.add', compact('about'));
        }
      
    }

    public function store(Request $request)
    {
        // Khởi tạo model AboutU tương ứng với bẳng about_us
        $about= new AboutU();
        $about->content = $request->content;
        $about->save();
        return redirect('about-us')->with('success', 'Added successfully');
    }

    public function edit()
    {
        $about = DB::table('about_us') ->latest('created_at')->first();
        return view('admin.pages.about-us.edit', compact('about'));
    }
    public function update(Request $request, $id)
    {
        $about = AboutU::find($id);
        $about->content = $request->content;
        
        
        $about->update();
        return redirect('about-us')->with('success', 'Edit successfully');
    }
    public function destroy($id)
    {
        $about = AboutU::find($id);
        $about->delete();
        return redirect('about-us')->with('success','Deleted success');
    }
}