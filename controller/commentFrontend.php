<?php
require('model/Post.php');
require('model/Comments.php');
require('model/Users.php');

function displayPostComments ($postId, $page, $postPerPage){

	$post = new Post("init", "init");
	$displayPost = $post->display($postId);

	$check = $post->checkPost($postId);
try{
	if($check &&  $page>0  && $postPerPage>0)
		{

			$comments = new Comment("init","init",0);
			$commentsList = $comments->listComment($postId, $page, $postPerPage);
			require('view/frontendPostCommentsView.php');
		}
	else
		{

			throw new Exception("Nous n'avons pas retrouvé le billet correspondant");
			
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
	if($check && !empty($author) && !empty($content) && strlen($author)<255 && strlen($content)<255 )
		{

			$comment->create();

			header("Location:index.php?id=".$postId."&page=1");
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


function alertComment($id, $postId, $pseudo, $page){

	$comment = new Comment("init", "init", 0);
	$comment->alert($id);

	$cookieName = "commentId".strval($id);
	setcookie($cookieName, $id, time() + 365*24*3600, null, null, false, true); 

	$post = new Post("init", "init");

	$check = $post->checkPost($postId);

try{
	if($check &&  $page>0)
		{
			header("Location:index.php?id=".$postId."&page=".$page);
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
