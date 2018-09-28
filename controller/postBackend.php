<?php
require('model/Post.php');

function postCreate($title, $content){

	$post = new Post($title, $content);
	
try{ 	
	if(!empty($title) && !empty($content) && strlen($title)<255 )
		{
			$post->create();
			header('Location:index.php?action=postListView');
		}
	else
		{
			throw new Exception("Vous devez remplir tous les champs.");
			
		}
	}
catch(Exception $e)
	{
		$errorMessage = 'Erreur : '.$e->getMessage();
		require('view/errorView.php');
	}


}

function postCreationView(){

	require('view/postCreationView.php');
}

function postListView ($page, $postPerPage){

	$post = new Post("init", "init");
try{ 
	if( $page>0  && $postPerPage>0)
		{
			$postList = $post->postList($page, $postPerPage);
			require('view/backendPostListView.php');
		}
	else
		{
			throw new Exception("La requete n'a pas pu être pris en compte.");
			
		}
	}
catch(Exception $e)
	{
		$errorMessage = 'Erreur : '.$e->getMessage();
		require('view/errorView.php');
	}
	

	

}

function postDelete($postId, $page){

	$post = new Post("init", "init");

	$check = $post->checkPost($postId);

try{
		if($check && $page>0)
			{
				$post->delete($postId);

				header('Location:index.php?action=postListView&page='.$page);
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

function postUpdate($title, $content, $postId, $page){

	$post = new Post($title, $content);

	$check = $post->checkPost($postId);

try{
	if($check && !empty($title) && !empty($content) && !empty($postId) && strlen($title)<255  && $page>0)
		{
			$post->update($postId);

			header('Location:index.php?action=postListView&page='.$page);
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