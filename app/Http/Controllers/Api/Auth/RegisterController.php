<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

//use Request;

/**
 * This handles registration for the Application
 * @Resource("Register")
 */
class RegisterController extends Controller
{
    //
    use RegistersUsers;
    use Helpers;

    /**
     * This is the function called when your try to register
     * 
     * @Get("/register")
     * @Versions({"V1"}) 
     * @Transaction({
     *     @Request({"name":"John Doe", "email":"test@email.com", "callup_no": "NYSC/BBCxxx"}),
     *     @Request({"state_id_val":"state id", "phone_no": "090xxxxxx", "password":"pwd"}),
     *     @Response(201, body={"token":"abc123xxx", "message":"User Created", "status_code": "201"}), 
     *     @Response(404, body={"status_code": "404", "message": "User not found"})  
     * }) 
     *    
     */
    public function register(Request $request)
    {
        //return response()->json(['kunle' => 'odegbaro']);
        //return response()->json($request->all());
    	$validator = $this->validator($request->all());


    	if($validator->fails()){
    		throw new StoreResourceFailedException("Validation Error", $validator->errors());
            //return response()->json($validator->errors(), 404);
    	}

    	$user = $this->create($request->all());

    	if($user){
    		$token = JWTAuth::fromUser($user);

    		return $this->response->array([
    			"token" => $token,
    			"message" => "User created",
    			"status_code" => 200
    		]);
    	}else{
    		return $this->response->error("User Not Found...", 404);
    	}
    }//end

    protected function validator(array $data)
    {
        //we need to add the email cos we need it for my JWT to authenticate my system
        //cos it uses email and pwd for the login. hence may be we remove username for nau
    	return Validator::make($data, [
    		#'name' => 'required|min:4',
    		'email' => 'required|email|max:255|unique:users',
            'username' => 'required|alpha_dash|unique:users',
    		#'gender' => 'required|max:3',
    		'callup_no' => 'required',
    		#'state_id_val' => 'required',
    		#'phone_no' => 'required',
    		'password' => 'required|min:5',
    	]);
    }

    protected function create(array $data)
    {
    	return User::create([
    		#'name' => $data['name'],
            'email' => $data['email'],
    		'username' => $data['username'],
    		#'gender' => $data['gender'],
    		#'state_id_val' => $data['state_id_val'],
    		'callup_no' => $data['callup_no'],
    		#'phone_no' => $data['phone_no'],
    		'password' => bcrypt($data['password']),
    	]);
    }
}
