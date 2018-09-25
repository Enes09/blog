<?php
require('model/Post.php');

function postCreate($title, $content){

	$post = new Post($title, $content);

	$post->create();

	header('Location:index.php?action=postListView');

}

function postCreationView(){

	require('view/postCreationView.php');
}

function postListView (){

	$post = new Post("init", "init");

	$postList = $post->postList();

	require('view/backendPostListView.php');

}

function postDelete($postId){

	$post = new Post("init", "init");

	$check = $post->checkPost($postId);

try{
		if($check)
			{
				$post->delete($postId);

				header('Location:index.php?action=postListView');
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

function postView($postId){

	$post = new Post("init", "init");

	$check = $post->checkPost($postId);

try{

	if($check)
		{
			$display = $post->display($postId);

			require('view/postUpdateView.php'); 
		}
	else
		{
			throw new Exception("Nous n'avons pas trouvé le billet correspondant.");
			
		}
	}

catch(Exception $e)
	{
		$errorMessage = 'Erreur : '.$e->getMessage();
		require('view/errorView.php');
	}

}

function postUpdate($title, $content, $postId){

	$post = new Post($title, $content);

	$check = $post->checkPost($postId);

try{
	if($check)
		{
			$post->update($postId);

			header('Location:index.php?action=postListView');
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