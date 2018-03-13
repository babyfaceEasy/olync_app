<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use File;
use Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //this gets the current authenticated user state id
      $user_id = Auth::id();
      $user = User::find($user_id);
      if ($user->state_id_val == null) {
        $state_id = 25;
      }else {
        $state_id = $user->state_id_val;
      }

      //now select all posts from thi state
      //select all posts then filter based on the state the person chooses
      $posts = Post::withCount('comments')->orderBy('created_at', 'desc')->get();
      $posts =  $posts->filter(function($value, $key) use($state_id){
        return $state_id == $value->user->state_id_val;
      });
      //dd($posts);
      return view('home', compact('posts'));
    }

    //this is to get post pics
    public function getPostpic(Request $request, $pic_name)
    {
        $path = storage_path('app/public/post_pics/' . $pic_name);

        //dd($path);

        if (!File::exists($path)) {
            //abort(404);
            return response('Image not available', 404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }//end of getPostpic
}
