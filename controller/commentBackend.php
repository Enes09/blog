<?php
require('model/Post.php');
require('model/Comments.php');

function commentsView($postId){

	$post = new Post("init", "init");
	$comment = new Comment("init", "init", $postId);

	$check = $post->checkPost($postId);

	if($check)
		{
			$displayPost = $post->display($postId);
			$listComment = $comment->listComment($postId);
			require('view/backendCommentsView.php');
		}
	else
		{
			throw new Exception("Nous n'avons pas pu retrouver le billet correspondant.");
		}
}

function deleteComment($commentId, $postId){

	$post = new Post("init", "init");
	$comment = new Comment("init", "init", $postId);

	$check = $post->checkPost($postId);

	if($check)
		{
			$comment->delete($commentId);
			$listComment = $comment->listComment($postId);
			header('Location:index.php?action=commentsView&id='.$postId);
		}
	else
		{
			throw new Exception("Nous n'avons pas pu retrouver le billet correspondant.");
		}

}

function validateComment($commentId, $postId){

	$post = new Post("init", "init");
	$comment = new Comment("init", "init", $postId);

	$check = $post->checkPost($postId);

	if($check)
		{
			$comment->validate($commentId);
			$listComment = $comment->listComment($postId);
			header('Location:index.php?action=commentsView&id='.$postId);
		}
	else
		{
			throw new Exception("Nous n'avons pas pu retrouver le billet correspondant.");
		}

}

function alertedCommentView(){

	$comment = new Comment("init", "init", 0);

	$alerted = $comment->alertedComments();

	require('view/alertedCommentView.php');

}

function deleteAlertedComment($commentId){

	$comment = new Comment("init", "init", 0);

	$comment->delete($commentId);

	header('Location:index.php?action=alertedCommentView');
}

function validateAlertedComment($commentId){

	$comment = new Comment("init", "init", 0);

	$comment->validate($commentId);

	header('Location:index.php?action=alertedCommentView');
	
}