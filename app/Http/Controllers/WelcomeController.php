<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        //if the users searches fr post
        // $search = request()->query('search');

        // if($search){
        //     $posts = Post::where('name', 'LIKE', "%{$search}%")->simplePaginate('4');
        // }else{
        //     $posts = Post::simplePaginate(4);
        // }

        return view('welcome')->with('categories', Category::all())->with('tags', Tag::all())->with('posts', Post::searched()->simplePaginate(4));
    }







}
