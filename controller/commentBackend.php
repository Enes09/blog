<?php
require('model/Post.php');
require('model/Comments.php');

function commentsView($postId, $page, $postPerPage){

	$post = new Post("init", "init");
	$comment = new Comment("init", "init", $postId);

	$check = $post->checkPost($postId);
try{
	if($check  && $page>0 && $postPerPage>0)
		{
			$displayPost = $post->display($postId);
			$listComment = $comment->listComment($postId, $page, $postPerPage);
			require('view/backendCommentsView.php');
		}
	else
		{
			throw new Exception("Nous n'avons pas pu retrouver le billet correspondant.");
		}
	}
catch(Exception $e)
		{
			$errorMessage = 'Erreur : '.$e->getMessage();
			require('view/errorView.php');
		}
}

function deleteComment($commentId, $postId, $page, $postPerPage){

	$post = new Post("init", "init");
	$comment = new Comment("init", "init", $postId);

	$check = $post->checkPost($postId);

try{
	if($check  && $commentId>0 && $page>0  && $postPerPage>0)
		{
			$comment->delete($commentId);
			$listComment = $comment->listComment($postId, $page, $postPerPage);
			header('Location:index.php?action=commentsView&id='.$postId.'&page='.$page);
		}
	else
		{
			throw new Exception("Nous n'avons pas pu retrouver le commentaire correspondant.");
		}
	}
catch(Exception $e)
		{
			$errorMessage = 'Erreur : '.$e->getMessage();
			require('view/errorView.php');
		}


}

function validateComment($commentId, $postId, $page, $postPerPage){

	$post = new Post("init", "init");
	$comment = new Comment("init", "init", $postId);

	$check = $post->checkPost($postId);

try{
	if($check  && $commentId>0  && $page>0  && $postPerPage>0)
		{
			$comment->validate($commentId);
			$listComment = $comment->listComment($postId, $page, $postPerPage);
			header('Location:index.php?action=commentsView&id='.$postId.'&page='.$page);
		}
	else
		{
			throw new Exception("Nous n'avons pas pu retrouver le commentaire correspondant.");
		}
	}
catch(Exception $e)
		{
			$errorMessage = 'Erreur : '.$e->getMessage();
			require('view/errorView.php');
		}


}

function alertedCommentView($page, $postPerPage){

	$comment = new Comment("init", "init", 0);

try{
	if( $page>0  && $postPerPage>0)
		{
			$alerted = $comment->alertedComments($page, $postPerPage);
			require('view/alertedCommentView.php');
		}
	else
		{
			throw new Exception("Nous n'avons pas pu retrouver le billet correspondant.");
		}
	}
catch(Exception $e)
		{
			$errorMessage = 'Erreur : '.$e->getMessage();
			require('view/errorView.php');
		}
	

}

function deleteAlertedComment($commentId, $page){

	$comment = new Comment("init", "init", 0);
try{
	if($commentId>0  && $page>0)
		{
			$comment->delete($commentId);
			header('Location:index.php?action=alertedCommentView&page='.$page);
		}
	else
		{
			throw new Exception("Nous n'avons pas pu retrouver le commentaire correspondant.");
		}
	}
catch(Exception $e)
		{
			$errorMessage = 'Erreur : '.$e->getMessage();
			require('view/errorView.php');
		}	
	

}

function validateAlertedComment($commentId, $page){

	$comment = new Comment("init", "init", 0);
try{
	if( $commentId>0  && $page>0)
		{
			$comment->validate($commentId);
			header('Location:index.php?action=alertedCommentView&page='.$page);
		}
	else
		{
			throw new Exception("Nous n'avons pas pu retrouver le commentaire correspondant.");
		}
	}
catch(Exception $e)
		{
			$errorMessage = 'Erreur : '.$e->getMessage();
			require('view/errorView.php');
		}	
	
}