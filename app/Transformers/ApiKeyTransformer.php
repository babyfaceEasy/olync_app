<?php

namespace App\Transformers;


use League\Fractal;
use Chrisbjr\ApiGuard\Models\ApiKey;


class ApiKeyTransformer extends Fractal\TransformerAbstract
{
	
	public function transform(ApiKey $apiKey)
	{
		return[
			'id' => (int) $apiKey->id,
			'user_id' => (int) $apiKey->user_id,
			'key' => $apiKey->key,
			'level' => (int) $apiKey->level,
			'ignore_limits' => (int) $apiKey->ignore_limits
		];
	}
}
