<?php
namespace App\Transformers;

use App\State;
use League\Fractal;

class StateTransformer extends Fractal\TransformerAbstract
{
	
	public function transform(State $state)
	{
		return[
			'state_id' => (int) $state->state_id,
			'name' => $state->name
		];
	}
}

