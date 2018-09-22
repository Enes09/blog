<?php
require('model/Post.php');
require('model/Comments.php');
require('model/Users.php');

function displayPostComments ($postId){

	$post = new Post("init", "init");
	$displayPost = $post->display($postId);

	$check = $post->checkPost($postId);

	if($check){

		$comments = new Comment("init","init",0);
		$commentsList = $comments->listComment($postId);
		require('view/frontendPostCommentsView.php');
	}
	else{

		throw new Exception("Nous n'avons pas retrouvé le billet correspondant.");
		
	}
	
}

function createComment ($author, $content, $postId){

	$comment = new Comment($author, $content, $postId);
	$comment->create();

	header("Location:index.php?id=".$postId);
}


function alertComment($id, $postId, $pseudo){

	$comment = new Comment("init", "init", 0);
	$comment->alert($id);

	$cookieName = "commentId".strval($id);
	setcookie($cookieName, $id, time() + 365*24*3600, null, null, false, true); 

	header("Location:index.php?id=". $postId);

	}

?>
