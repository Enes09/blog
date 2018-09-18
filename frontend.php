<?php
require('Post.php');
require('Comments.php');
require('Users.php');

if( isset($_COOKIE['login'], $_COOKIE['password'])){

	# va ouvrir une session puis va directement ouvrir la page pour ladrministrateur, lui ne va avoir uniquement en plus un onglet appeler dashbord ou nous allons incorporer les différentes fonctionnalités.

}
else
{


	$post = new Post("init", "init");
	$listOfPost = $post->postList();
	$numberOfPost = $post->countPost();


	if(isset($_GET['id']) || is_int($_GET['id']) || $_GET['id'] <= $numberOfPost || $_GET['id'] >= $numberOfPost )
		{
			echo "yes";
		}
	else
		{
			throw new Exception("Le billet correspondant à ce commentaire n'a pas pu être retrouver");
		}


	require('frontendView.php');
}