<?php

class AjaxController extends BaseController
{
	public function __construct()
	{
		$this->beforeFilter('staff');
	}

	public function ajax_add_comment()
	{
		$comment = Input::get('submitted_comment');

		if ($comment)
		{
			// Add comment to comments table, referencing the ticket id as fk
			$insert_comment = new Comment;
			$insert_comment->comments_master_fk = Input::get('ticket_id');
			$insert_comment->comments_users_fk = Auth::user()->users_id;
			$insert_comment->comments_comment = Input::get('submitted_comment');
			$insert_comment->save();

			// Add author and timestamp of new comment to comment text
			$comment_stamp = $insert_comment->updated_at;
			$comment_author = User::whereUsers_id($insert_comment->comments_users_fk)->first()->users_username;
			$comment_text = 'By <strong>' . $comment_author . '</strong> at ' . $comment_stamp . '<br />' . $comment;

			return json_encode(['comment_status' => 'success', 'comment_text' => $comment_text]);
		}

		return json_encode(['comment_status' => 'no content']);

	}

}
