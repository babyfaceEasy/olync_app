<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use App\State;
use Validator;

class UtilController extends Controller
{
	use Helpers;
    //this handles general features of olync_api

	//this gets all the states 
	public function getStates()
	{
		$states = State::all();
		//return response()->json($states);
		return $this->response->array($states->toArray());
	}

	public function testPost(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required'
		]);
		if ($validator->fails()) {
            throw new StoreResourceFailedException("Validation Error", $validator->errors());
            //return $this->response->errorWrongArgsValidator($validator->errors());
        }
		/*$this->validate($request, [
			'name' => 'required'
		]);*/
		$name = $request->input('name');
		//return $this->response->array($name->toArray());
		return response()->json(['name' => $name]);
	}
	public function index()
	{
		return State::all();
	}
}
