<?php
require('model/Comments.php');
require('model/Post.php');
require('model/Users.php');

function autoConnection ($login, $password){

	$user = new Administrator($login, $password);

	$data = $user->cookieControl();
	$data = $data->fetch();

	try 
		{
			if($_COOKIE['blogLogin'] === $data['login_cookie'] && password_verify( $_SERVER["REMOTE_ADDR"] ,$data['ip_cookie']) )
				{
					$user->connection();
					header('Location:index.php');
				}
			else
			{
				throw new Exception("La connection automatique a échoué.");
				
			}

		}
	catch(Exception $e)
		{
			$errorMessage = 'Erreur : '.$e->getMessage();
			require('view/errorView.php');
		}
}



function connection($login, $password, $auto){


	$user = new Administrator($login, $password);

	$data = $user->passControl();
#set cookie if auto is true
	try
		{
			if(password_verify($user->_password, $data['password']) && $user->_login === $data['login'])
				{
					$user->connection();
					#for the automatic connection
					if($auto === "on" )
						{
							
							$hashIp = password_hash($_SERVER["REMOTE_ADDR"], PASSWORD_DEFAULT);

							#put the hashed ip in bd with users method
							$user->tableCookie($hashIp, $login);

							setcookie( "blogLogin", $_SESSION['login'], time() + 365*24*3600, null, null, false, true);

							setcookie( "blogPassword", $hashIp, time() + 365*24*3600, null, null, false, true);

							header('Location:index.php');

						}
					else
						{
							header('Location:index.php');
						}

					
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

function cancelAuto(){
	$user = new Administrator("init", "init");

	$user->cancelAuto();

	disconnect();

}

