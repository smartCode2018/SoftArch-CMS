<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;

use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Middleware\VerifyCategoriesCount;
class PostsController extends Controller
{

    public function __construct()
    {
        //adding middleware to the create and store methods
       $this->middleware('verifyCategoriesCount')->only(['create', 'store']); 
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //dd($request->all());
    
         $image = $request->image->store('posts');

        // $imageName = time().'.'.$request->image->getClientOriginalExtension();
        // $image = $request->image->move(public_path('images'), $imageName);
        
        $post = Post::create([
            'name' => $request->name,
            'description' => $request->description,
            'content' => $request->content,
            'image'=> $image,
            'category_id'=>$request->category,
            'published_at' => $request->published_at,
            'user_id' => auth()->user()->id

        ]);

        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Post created successfully');

        return redirect(route('posts.index'));

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
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {
        //dd($request->all());
        $data = $request->only([
           'name', 'description', 'published_at', 'content'
        ]);


        if($request->hasFile('image')){
            $image = $request->image->store('posts');    
            
            $post->deleteImage();
        
            $data['image'] = $image;
        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        $data['category_id'] = $request->category;

        $post->update($data);

        session()->flash('success', 'Post updated successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if($post->trashed()){
            //function from the modal to delete the image
            $post->deleteImage();

            $post->forceDelete();
        }else{
            $post->delete();
        }
        

        session()->flash('success', 'Post deleted successfully');

        return redirect(route('posts.index'));
    }

    public function trashed(){
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts', $trashed);
    }

    public function restore($id){

        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();

        session()->flash('success', 'Post restored successfully');

        return redirect()->back();
    }


}
