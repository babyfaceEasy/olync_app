<?php

namespace App\Transformers;

use App\Forum;
use League\Fractal;
use Illuminate\Support\Collection;


/**
* 
*/
class ForumTransformer extends Fractal\TransformerAbstract
{
	
	public function transform( Collection $forum )
	{
		/*return [
			'id' => (int) $forum->id,
			'user_id' => (int) $forum->user_id,
			'topic' => $forum->topic,
			'content' => $forum->content,
			'reach' => $forum->reach,
			'created_at' => date('d-m-Y H:i:s', strtotime($forum->created_at)),
			'updated_at' => date('d-m-Y H:i:s', strtotime($forum->updated_at)),
		];*/

		return [
			'id' => (int) $forum->id,
			'topic' => $forum->topic,
			'owner' => $forum->owner,
			'state_name' => $forum->state_name,
			'no_of_comments' => (int)$forum->no_of_comments,
			'timing' => $forum->timing
		];
	}
}
