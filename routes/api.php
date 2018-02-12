<?php


use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//routes that don't require authentication
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
	/*$api->get('/get-states', 'App\Http\Controllers\UtilController@getStates');
	$api->post('/test-post', 'App\Http\Controllers\UtilController@testPost');*/

	//codes
	$api->get('/states', 'App\Http\Controllers\Api\StateController@getAllStates')->name('get_all_states');
	$api->post('/login', 'App\Http\Controllers\Api\Auth\LoginController@login');
	$api->post('/register', 'App\Http\Controllers\Api\Auth\RegisterController@register');

	//authenticated links
	$api->group(['middleware' => 'api.auth'], function($api){
		$api->get('/logout', 'App\Http\Controllers\Api\Auth\LoginController@logout');
		$api->get('/user-dets', 'App\Http\Controllers\Api\UserController@getUserDets');

		//postController
		$api->post('/new-post', 'App\Http\Controllers\Api\PostController@newPost');
		$api->get('/state-posts/{state_id?}', 'App\Http\Controllers\Api\PostController@statePosts');
		$api->get('/user-posts', 'App\Http\Controllers\Api\PostController@userPosts');
		$api->get('/post-like/{post_id}', 'App\Http\Controllers\Api\PostController@postLike');
		$api->get('/post-like/{post_id}/count', 'App\Http\Controllers\Api\PostController@getPostLikes');
		$api->get('/post-image/{pic_name}', 'App\Http\Controllers\Api\PostController@getPostpic');

		//postCommentController
		$api->post('/add-comment/{post_id}', 'App\Http\Controllers\Api\PostCommentController@newComment');
		$api->get('/post/{post_id}/comments', 'App\Http\Controllers\Api\PostCommentController@getPostComments');

		//usercontroller
		$api->post('/change-password', 'App\Http\Controllers\Api\UserController@changePassword');
		$api->post('/update-info', 'App\Http\Controllers\Api\UserController@updateUserInfo');
		$api->get('/user-info-username', 'App\Http\Controllers\Api\UserController@getUserByUsername');
		$api->get('/user-profile/{pic_name}', 'App\Http\Controllers\Api\UserController@getProfilePic');
		$api->get('/reset-profile-pic', 'App\Http\Controllers\Api\UserController@defaultProfilePic');
		$api->post('/upload-profile-pic', 'App\Http\Controllers\Api\UserController@uploadProfilePic');
		$api->get('/find-friends/{user?}', 'App\Http\Controllers\Api\UserController@searchFriendByUsername');
		$api->post('/edit-username', 'App\Http\Controllers\Api\UserController@editUsername');
	});
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
