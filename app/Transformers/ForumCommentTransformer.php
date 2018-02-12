<?php

namespace App\Transformers;

use App\ForumComment;
use League\Fractal;


/**
* 
*/
class ForumCommentTransformer extends Fractal\TransformerAbstract
{
	
	public function transform(ForumComment $forumComment)
	{
		return [
			'id' => (int) $forumComment->id,
			'user_id' => (int) $forumComment->user_id,
			'forum_id' => (int) $forumComment->forum_id,
			'comment' => $forumComment->comment,
			'created_at' => date('d-m-Y H:i:s', strtotime($forumComment->created_at)),
			'updated_at' => date('d-m-Y H:i:s', strtotime($forumComment->updated_at)),
		];
	}
}
