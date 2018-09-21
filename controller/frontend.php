<?php
require('model/Post.php');
require('model/Comments.php');
require('model/Users.php');

#if( isset($_COOKIE['login'], $_COOKIE['password'])){

	# va ouvrir une session puis va directement ouvrir la page pour ladrministrateur, lui ne va avoir uniquement en plus un onglet appeler dashbord ou nous allons incorporer les différentes fonctionnalités.

#}
#else
#{

#}

function  postsList(){

	$post = new Post("init", "init");
	$listOfPost = $post->postList();
	
	require('view/frontendPostsListView.php');
}

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
