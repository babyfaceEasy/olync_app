<?php

namespace App\Http\Controllers\Api;


use App\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Image;
use File;

/**
 * This handles all that has to do with a user.
 * @Resource("User")
 */
class UserController extends Controller
{
    use Helpers;

    /**
     * Returns the current user details
     * @param  Request $request 
     * @return JSONARRAY           An array consisting of the users list
     * @Get("/user-dets")
     */
    public function getUserDets(Request $request)
    {
    	$user = $this->auth->user();

    	return isset($user) ? $this->response->array($user->toArray()) : $this->response->errorNotFound();
    }
    //update user
    //change password
    
    public function changePassword(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'curPassword' => 'required|min:4',
    		'newPassword' => 'required|min:4'
    	]);

    	if($validator->fails()){
    		throw new StoreResourceFailedException('Validation Errors', $validator->errors());
    	}

    	$user = $this->auth->user();
    	if(!isset($user)){
    		return $this->response->errorNotFound();
    	}

    	//check if they mash
    	if(Hash::check($request->input('curPassword'), $user->password)){
    		$user = User::find($user->id); 
    		$user->password = Hash::make($request->input('newPassword'));
    		$user->save();

    		return response()->json(['status_code' => 200, 'message' => 'password change was successful' ]);
    	}else{
    		$response = ['errors' => [
    				'message' => 'Your Old password doesn\'t match'
    			]
    		];
    		throw new StoreResourceFailedException('Password Error', $response); 
    	}

    	$response = ['errors' => [
    			'message' => 'An error occured, please try again later.'
    		]
    	];
    	throw new StoreResourceFailedException('Password Creation Error', $response);
    	
    }//end of changePassword

    public function updateUserInfo(Request $request)
    {
    	//u can change ur name, phone_no, state_id, gender and short_bio
    	$validator = Validator::make($request->all(), [
    		'name' => 'min:4',
    		'phone_no' => 'min:8',
    		'state_id_val' => '',
            'gender' => '',
            'short_bio' => 'max:150'
    	]);

    	if($validator->fails()){
    		throw new StoreResourceFailedException('Validation Errors', $validator->errors());
    	}

    	$user = $this->auth->user();
    	if(!isset($user)){
    		return $this->response->errorNotFound();
    	}

    	$input = $request->only('name', 'phone_no', 'state_id_val');

    	$ret = User::where('id', $user->id)->update($input);

    	if(is_null($ret)){
    		$res = ['message' => 'An error occured, pleas try again later.'];
    		throw new StoreResourceFailedException('Validation Errors', $res);
    	}else{
    		return response()->json(['status_code' => 200, 'message' => 'successful!!']);
    	}
    }//end of updateUserInfo

    public function editUsername(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|alpha_dash|unique:users'
        ]);

        if($validator->fails()){
            throw new StoreResourceFailedException('Validation Errors', $validator->errors());
        }

        $user = $this->auth->user();
        if(!isset($user)){
            return $this->response->errorNotFound();
        }

        $input = $request->only('username');

        $ret =User::where('id', $user->id)->update($input);

        if(is_null($ret)){
            $res = ['message' => 'An error occured, pleas try again later.'];
            throw new StoreResourceFailedException('Validation Errors', $res);
        }else{
            return response()->json(['status_code' => 200, 'message' => 'successful!!']);
        }


    }//end of editUsername

    public function getUserByUsername($username)
    {
    	$user = User::where('username', $username)->first();

    	return response()->json(['status_code' => 200, 'data' => $user->toArray()]);
    }

    public function uploadProfilePic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:3048'
        ]);

        if($validator->fails()){
            throw new StoreResourceFailedException('Validation Errors', $validator->errors());
        }

        $user = $this->auth->user();
        if(!isset($user)){
            return $this->response->errorNotFound();
        }

        //check if file is available
        if($request->hasFile('img') && $request->img->isValid()){
            //we would be saving the users profile pic wiv id.extension
            //here store first paremeter is null cos 'postPics' leads directly to the needed folder. 
            //extension
            $ext = $request->file('img')->extension();
            $name = 'avatar_'.$user->id.".".$ext;
            $path = $request->file('img')->storeAs('profile_pics', $name, 'public');
        }

        //dd($path);
        $input['profile_pic'] = $name;
        //dd($input);
        $ret = Post::where('id', $user->id)->update($input);
        if (is_null($ret)) {
            //bad message
            return $this->response->errorInternal('An error occured, please try again later.');
        }else{
            return response()->json(['message' => 'Profile picture change was sucessful!', 'status_code' => '200']);
        }
    }//end of uploadProfilePic()

    //this is to drop picture 
    public function defaultProfilePic(Request $request)
    {
        //delete the current file as long as default.jpg
        $user = $this->auth->user();
        if(!isset($user)){
            return $this->response->errorNotFound();
        }

        //try and delete the existing file

        if ($user->profile_pic != 'default.jpg'){
            $user = User::where('id', $user->id)->update(['profile_pic' => 'default.jpg']);
            return response()->json(['status_code' => 200, 'message' => 'Successful!']);
        }
        return response()->json(['status_code' => 200, 'message' => 'Successful!']);
    }//end of defaultProfilePic

    //this returns profile image based on the name
    public function getProfilePic($pic_name)
    {
        //return storage_path('public/profile_pics/' .$pic_name);
        return Image::make(storage_path('public/profile_pics/' .$pic_name))->response();
    }

    public function getProfilepic2($pic_name)
    {
        $path = storage_path('public/profile_pics/' . $pic_name);

        if (!File::exists($path)) {
            //abort(404);
            return $this->response->error('Image not available', 404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }//end of getProfilepic2

    public function searchFriendByUsername(Request $request)
    {
        $username = $request->input('username');
        try {
            $friends = User::where('username', 'LIKE', '%'.$username.'%')->get();
        } catch (Exception $e) {
            \Log::error($e);
            return $this->response->errorInternal('An error occured, please try again later.');
        }
        
        return response()->json(['status_code' => 200, 'data' => $friends->toArray()]);
    }//end of searchFriendByUsername
}//end of class
