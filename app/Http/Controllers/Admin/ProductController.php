<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!empty($request->search)){
            $product = DB::table('product')
                ->where('name', 'like', '%'.$request->search.'%')
                ->simplePaginate(10);
        }
        else{
            $product = DB::table('product')->simplePaginate(10);
        }
        return view('admin.pages.product.index', compact('product'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.pages.product.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'image' => 'max:300',
        ])->validate();
        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->price_sale = $request->price_sale;
        $product->price = $request->price;
        $product->cost = $request->cost;
        $product->category   = $request->category;
        $product->number   = $request->number;
        $product->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $nameImgs = [];
            foreach ($file as $key => $value) {
                $ext = $value->getClientOriginalExtension(); 
                $filename = time() .'-' . $key . '.' . $ext;
                $value->move('assets/uploads/product', $filename);
                $nameImgs[] = $filename;
            }
            $product->image = implode(",",$nameImgs);
        }
        $tempSize = [];
        foreach(config('constants.size') as $size) {
            if($request->has($size)){
                $tempSize[] = $size;
            }
        }
        $product->size = implode(",", $tempSize);
        $product->save();
        return redirect('product/create')->with('success', 'Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.pages.product.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'image' => 'max:300',
        ])->validate();
        $product = Product::find($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->price_sale = $request->price_sale;
        $product->price = $request->price;
        $product->cost = $request->cost;
        $product->category   = $request->category;
        $product->number   = $request->number;
        $product->description = $request->description;
        if($request->hasFile('image')){
            $images = explode(',', $product->images);
            foreach($images as $image){
                $path = 'assets/uploads/product/' . $image;
                if(File::exists($path)){
                    File::delete($path);
                }
            }
            $file = $request->file('image');
            $nameImgs = [];
            foreach ($file as $key => $value) {
                $ext = $value->getClientOriginalExtension(); 
                $filename = time() .'-' . $key . '.' . $ext;
                $value->move('assets/uploads/product', $filename);
                $nameImgs[] = $filename;
            }
            $product->image = implode(",",$nameImgs);
        }
        foreach(config('constants.size') as $size) {
            if($request->has($size)){
                $tempSize[] = $size;
            }
        }
        $product->size = implode(",", $tempSize);
        $product->update();
        return redirect('product')->with('success', 'Edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product->image){
            $path = 'assets/uploads/product/' . $product->image;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $product->delete();
        return redirect('product')->with('success','Deleted success');
    }
}
