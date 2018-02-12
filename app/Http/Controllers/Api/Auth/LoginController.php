<?php

namespace App\Http\Controllers\Api\Auth;

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

/**
 * This handles login Activities
 * @Resource("Login")
 */
class LoginController extends Controller
{
    //
    use AuthenticatesUsers;
    use Helpers;

    /**
     * This is the function called, when you try to make a login.
     *
     * @Post("/login")
     * @Versions({"V1"})
     * @Request({"email": "email@email.com", "password": "password"})
     * @Response(200, body={"token": "abc123", "status_code": "200", "message":"User Authenticated"})
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        if($validator->fails()){
            throw new StoreResourceFailedException("Validation Error", $validator->errors());
        }

    	$user = User::where('email', $request->email)->first();
    	if($user && Hash::check($request->get('password'), $user->password)){
    		$token = JWTAuth::fromUser($user);

    		return $this->sendLoginResponse($request, $token);
    	}

    	return $this->sendFailedLoginResponse($request);
    }

    public function sendLoginResponse(Request $request, $token)
    {
    	$this->clearLoginAttempts($request);

    	return $this->authenticated($token);
    }

    public function authenticated($token)
    {
    	return $this->response->array([
    		'token' => $token,
    		'status_code' => 200,
    		'message' => 'User Authenticated',
    	]);
    }

    public function sendFailedLoginResponse()
    {
    	throw new UnauthorizedHttpException("Bad Credentials");
    }


    /**
     * Logout out from olync API
     * @Get("/logout")
     * @Versions({"V1"})
     * 
     */
    public function logout()
    {
    	$this->guard()->logout();
    }
}//end of class
