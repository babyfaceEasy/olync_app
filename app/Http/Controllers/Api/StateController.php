<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use App\State;

/**
 * States in Nigeria resource representation
 * @Resource("States")
 */
class StateController extends Controller
{
	use Helpers;
	/**
	 *
	 * Returns all the states in Nigeria
	 *
	 * @Get("/states")
	 * @Versions({"v1"})
	 */
    public function getAllStates(Request $request)
    {
    	$states = State::all();
    	return $this->response->array($states->toArray())->setStatusCode(200);
    } 
}
