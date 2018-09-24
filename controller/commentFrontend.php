<?php
require('model/Post.php');
require('model/Comments.php');
require('model/Users.php');

function displayPostComments ($postId){

	$post = new Post("init", "init");
	$displayPost = $post->display($postId);

	$check = $post->checkPost($postId);
try{
	if($check)
		{

			$comments = new Comment("init","init",0);
			$commentsList = $comments->listComment($postId);
			require('view/frontendPostCommentsView.php');
		}
	else
		{

			throw new Exception("Nous n'avons pas retrouvé le billet correspondant.");
			
		}
	}
catch(Exception $e)
	{
		$errorMessage = 'Erreur : '.$e->getMessage();
		require('view/errorView.php');
	}
	
}

function createComment ($author, $content, $postId){

	$comment = new Comment($author, $content, $postId);
	$post = new Post("init", "init");

	$check = $post->checkPost($postId);

try{
	if($check)
		{

			$comment->create();

			header("Location:index.php?id=".$postId);
		}
	else
		{
			throw new Exception("Nous n'avons pas retrouvé le billet correspondant.");
			
		}
	}
catch(Exception $e)
	{
		$errorMessage = 'Erreur : '.$e->getMessage();
		require('view/errorView.php');
	}
	
}


function alertComment($id, $postId, $pseudo){

	$comment = new Comment("init", "init", 0);
	$comment->alert($id);

	$cookieName = "commentId".strval($id);
	setcookie($cookieName, $id, time() + 365*24*3600, null, null, false, true); 

	$post = new Post("init", "init");

	$check = $post->checkPost($postId);

try{
	if($check)
		{
			header("Location:index.php?id=". $postId);
		}
	else
		{
			throw new Exception("Nous n'avons pas retrouvé le billet correspondant.");
			
		}
	}
catch(Exception $e)
	{
		$errorMessage = 'Erreur : '.$e->getMessage();
		require('view/errorView.php');
	}

	
	}

?>
