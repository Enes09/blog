<?php
require('model/Post.php');
require('model/Comments.php');
require('model/Users.php');


function  postsList($page, $postPerPage){

	$post = new Post("init", "init");
try{
	if( $page>0  && $postPerPage>0)
		{
			$listOfPost = $post->postList($page, $postPerPage);
			require('view/frontendPostsListView.php');
		}
	else
		{
			throw new Exception("La requete n'a pas pu être retrouver.");
			
		}
	}
catch(Exception $e)
		{
			$errorMessage = 'Erreur : '.$e->getMessage();
			require('view/errorView.php');
		}
	
}



