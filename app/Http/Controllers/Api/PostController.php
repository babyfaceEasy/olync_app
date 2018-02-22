<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Like;
use App\PostComment;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Transformers\PostTransformer;
use File;
use Response;
use DB;

class PostController extends Controller
{
	use Helpers;
    //TODO: returns all posts in your state
    //TODO: returns post based on a state
    //TODO: posts for trending things
    //TODO: newsfeed
    //TODO: create a new post
    //TODO: get all likes on a post
    //TODO: get all comments on a post

    /**
     * This is to create a new-post
     * @param  Request $request
     * @return bolean true/false
     */
    public function newPost(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'post' => 'required|max:400',
    		'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048'
    	]);

    	if($validator->fails()){
    		throw new StoreResourceFailedException('Validation Errors', $validator->errors());
    	}

    	//check if file is available
    	if($request->hasFile('img') && $request->img->isValid()){
    		//if successful, $path = "jpvL79mdsZ4w1sD95XsWYKKtNlJfPu6QAgfgpjrC.jpeg"
    		//here store first paremeter is null cos 'postPics' leads directly to the needed folder.
    		$path = $request->file('img')->store(null, 'postPics');
    	}

    	//dd($path);
    	$input = $request->only('post');
    	$input['pic_name'] = $path;
    	$user = $this->auth->user();
    	if(!isset($user)){
    		return $this->response->errorNotFound();
    	}
    	$input['user_id'] = $user->id;

    	//dd($input);

    	$ret = Post::create($input);
    	if (is_null($ret)) {
    		//bad message
    		return $this->response->errorInternal('An error occured, please try again later.');
    	}else{
    		return response()->json(['message' => 'Post creation was succesful!', 'status_code' => '200']);
    	}
    }//end newPost()

    public function statePosts($state_id = null)
    {

    	//this returns post of the current user
        $user = $this->auth->user();
        if(!isset($user)){
            return $this->response->errorNotFound();
        }
    	if(is_null($state_id) && !is_null($user)){
    		$state_id = $user->state_id_val;
    	}

        //this is to check if the current user has liked this post
        /*$liked = false;
        $checker = Like::where('user_id', $user->id)->where('post_id', $post_id)->get();
        if ($checker->count() > 0) {
            $liked = true;
        }*/

    	//$state_id = 2;
    	//run the codes to get states based on the logged in user
    	$states = Post::withCount('comments')->orderBy('created_at', 'desc')->get();
    	$states = $states->filter(function($value, $key) use($state_id){
    		return $value->user->state_id_val == $state_id;
    	});

        $states = $states->map(function($state) use($user) {
            $checker = Like::where('user_id', $user->id)->where('post_id', $state->id)->count();
            $val = ($checker > 0 ) ? true : false;
            $state['liked'] = $val;
            return $state;
        });

    	return $this->response->array($states)->setStatusCode(200);
    	//dd($states);
    }//end statePosts

    public function userPosts()
    {
    	$user = $this->auth->user();
    	if(!isset($user)){
    		return $this->response->errorNotFound();
    	}
    	$userPosts = Post::withCount('comments')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $userPosts = $userPosts->map(function($userPost) use($user) {
            //dump($user->id);
            $checker = Like::where('user_id', $user->id)->where('post_id', $userPost->id)->count();
            $val = ($checker > 0 ) ? true : false;
            $userPost['liked'] = (bool)$val;
            return $userPost;
        });
        //dd($userPosts);
    	$ret_val = ['data' => $userPosts->toArray(), 'status_code' => 200];
    	return $this->response->array($ret_val)->setStatusCode(200);
    }//end of userPost()

    public function postLike(Request $request, $post_id)
    {
    	//this works like a toggle; the links decides on what to do
    	//i.e either it should like or unlike the comment.
    	$user = $this->auth->user();
    	if(!isset($user)){
    		return $this->response->errorNotFound();
    	}

    	$checker = Like::where('user_id', $user->id)->where('post_id', $post_id)->get();
    	if($checker->count() > 0){
    		//it exists so remove and reduce post likes by 1
    		$delRows = Like::where('user_id', $user->id)->where('post_id', $post_id)->delete();

            //this removes from the
            //Post::where('id', $post_id)->get()->decrement('likes');
            DB::table('posts')->whereId($post_id)->decrement('likes');
    	}else{
    		//the user is lliking the image back, hence add the person
    		$newLike = new Like();
    		$newLike->user_id = $user->id;
    		$newLike->post_id = $post_id;
    		$newLike->save();

            //update the likes in the user table
            //Post::where('id', $post_id)->get()->increment('likes');
            DB::table('posts')->whereId($post_id)->increment('likes');
    	}
    	return response()->json(['message' => 'Action was successful!', 'status_code' => 200]);
    }

    public function getPostLikes(Request $request, $post_id)
    {
    	$like_count = Like::where('post_id', $post_id)->count();

    	return response()->json(['data' => $like_count, 'status_code' => 200]);
    }

    //this is to get post pics
    public function getPostpic($pic_name)
    {
        $path = storage_path('app/public/post_pics/' . $pic_name);

        //dd($path);

        if (!File::exists($path)) {
            //abort(404);
            return $this->response->error('Image not available', 404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }//end of getPostpic
}
