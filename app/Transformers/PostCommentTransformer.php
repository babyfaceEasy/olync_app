<?php

namespace App\Transformers;


use League\Fractal;
use App\Postcomment;


class PostCommentTransformer extends Fractal\TransformerAbstract
{
	
	public function transform(PostComment $post_comment)
	{
		return[
			'id' => (int) $post_comment->id,
			'post_id' => (int) $post_comment->post_id,
			'user_id' => (int)$post_comment->user_id,
			'comment' => $post_comment->comment,
			'created_at' => date('d-m-Y', strtotime($post_comment->created_at)),
			'updated_at' => date('d-m-Y', strtotime($post_comment->updated_at)),
		];
	}
}
