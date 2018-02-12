<?php

namespace App\Transformers;


use League\Fractal;
use App\Post;


class PostTransformer extends Fractal\TransformerAbstract
{
	
	public function transform(Post $post)
	{
		return[
			'id' => (int) $post->id,
			'user_id' => (int) $post->user_id,
			'post' => $post->post,
			'pic_name' => $post->pic_name,
			'likes' => (int) $post->likes,
			'created_at' => date('d-m-Y', strtotime($post->created_at)),
			'updated_at' => date('d-m-Y', strtotime($post->updated_at)),
		];
	}
}
