<?php

namespace App\Transformers;

use App\User;
use League\Fractal;


/**
* 
*/
class UserTransformer extends Fractal\TransformerAbstract
{
	
	public function transform(User $user)
	{
		return [
			'id' => (int) $user->id,
			'state_id' => (int) $user->state_id,
			'callup_no' => $user->callup_no,
			'username' => $user->username,
			'gender' => $user->gender,
			'batch' => $user->batch,
			'year' => $user->year,
			'number' => $user->number,
			'name' => $user->name,
			'email' => $user->email,
			'profile_pic' => $user->profile_pic,
			'api_token' => $user->api_token,
			'short_bio' => $user->short_bio,
			'created_at' => date('d-m-Y H:i:s', strtotime($user->created_at)),
			'updated_at' => date('d-m-Y H:i:s', strtotime($user->updated_at)),
		];
	}
}
