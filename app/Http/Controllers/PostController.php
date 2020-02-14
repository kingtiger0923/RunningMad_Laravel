<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use DateTime;
use Input;
Use Auth;
use Storage;
Use App\Event;
Use App\Campaign;
Use App\Appeal;
Use App\Category;
Use App\Post;
Use App\User;
Use Cart as Cart;

class PostController extends Controller
{
    
    public function index(Request $request) {
        if ($request->has('filter')){
            if($request->input('filter') == 'all'){
                $data = Post::orderBy('created_at', 'desc')->get();
            } else {
                $category = Category::where('slug', $request->input('filter'))->first();
                $data =  $category->posts()->get();
            }
        } else {
           $data = Post::orderBy('created_at', 'desc')->get();
        }
        $campaigns = Campaign::all();
        $categories = Category::all();
        return view('post')->with(array('data'=> $data, 'categories'=> $categories, 'allcampaigns'=> $campaigns));
    
    }
   
    public function show($slug) {
        $post = Post::where('slug', '=', $slug)->firstOrFail();
        $allposts = Post::orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        $data = Campaign::all();
        return view('post-single')->with(array('post'=> $post, 'categories'=> $categories, 'allposts'=> $allposts,'allcampaigns'=> $data));
	}
  
}
