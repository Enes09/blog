<?php
require('model/Comments.php');
require('model/Post.php');
require('model/Users.php');


function connection($login, $password, $auto){


	$user = new Administrator($login, $password);

	$data = $user->passControl();
#set cookie if auto is true
	try
		{
			if(password_verify($user->_password, $data['password']) && $user->_login === $data['login'])
				{
					$user->connection();
					header('Location:index.php');
				}
			else
			{
				throw new Exception("Le mot de passe ou le login ne sont pas correct.");
			}

		}

	catch(Exception $e)
		{
			$errorMessage = 'Erreur : '.$e->getMessage();
			require('view/errorView.php');
		} 

}

function showHome(){
	require('view/homeView.php');
}

function disconnect(){

$user = new Administrator("init", "init");

$user->disconnection();

header('Location:index.php');

}