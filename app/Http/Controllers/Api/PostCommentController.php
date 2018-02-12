<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\PostComment;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Transformers\PostTransformer;

class PostCommentController extends Controller
{
	use Helpers;
    public function newComment(Request $request, $post_id)
    {
    	$validator = Validator::make($request->all(), [
    		'comment' => 'required'
    	]);

    	$user = $this->auth->user();
    	if(!isset($user)){
    		return $this->response->errorNotFound();
    	}

    	//save to the db nau
    	$input = $request->only('comment');
    	$input['post_id'] = $post_id;
    	$input['user_id'] = $user->id;

    	$ret = PostComment::create($input);

    	if(is_null($ret)){
    		//bad message
    		return $this->response()->errorInternal('An error occured, please try again later.');
    	}
    	return response()->json(['message' => 'Comment has been added!', 'status_code' => 200]);
    }

    public function getPostComments(Request $request, $post_id)
    {
    	$comments = PostComment::where('post_id', $post_id)->with('user')->get();

    	return response()->json(['status_code' => 200, 'data' => $comments->toArray()]);
    }
}
