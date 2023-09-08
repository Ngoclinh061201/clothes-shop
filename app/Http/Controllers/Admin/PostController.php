<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!empty($request->search)){
            $post = DB::table('post')
                ->where('name', 'like', '%'.$request->search.'%')
                ->simplePaginate(10);
               
                
        }
        else{
            $post = DB::table('post')->simplePaginate(10);
        }
        return view('admin.pages.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.post.add');
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
        $post = new Post();
        $post->name = $request->name;
        $post->slug = $request->slug;
        $post->content = $request->content_post;
        $post->user_id = Auth::user()->id;
        $post->view = 0;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/post', $filename);
            $post->image = $filename;
        }
        $post->save();
        return redirect('post/create')->with('success', 'Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       dd ($post);
        return view('admin.pages.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'image' => 'max:300',
        ])->validate();
        $post = Post::find($id);
        $post->name = $request->name;
        $post->slug = $request->slug;
        $post->content = $request->content_post;
        if($request->hasFile('image')){
            $path = 'assets/uploads/post/' . $post->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/post', $filename);
            $post->image = $filename;
        }
        $post->update();
        return redirect('post')->with('success', 'Edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post->image){
            $path = 'assets/uploads/post/' . $post->image;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $post->delete();
        return redirect('post')->with('success','Deleted success');
    }
}
