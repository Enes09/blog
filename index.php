<?php
session_start();
if(isset($_SESSION['login'])){

	if(isset($_GET['connection'] ) && $_GET['connection'] === "disconnect" )
		{
			require('controller/usersBackend.php'); disconnect();
		}

	require('controller/usersBackend.php'); showHome();

}


else{

		try{
			#check if commentId parameter exist.
			if( isset($_GET['commentId']) )
				{
							require('controller/commentFrontend.php'); alertComment($_GET['commentId'], $_GET['id'], $_GET['pseudo']);
				}

			else if(isset($_GET['connection']))
				{
					if($_GET['connection'] === "connect"){

						require('controller/usersBackend.php'); connection($_POST['login'], $_POST['password'], $_POST['auto']);

					}
					
					
					else{

						throw new Exception("La connection a échoué.");
						
					}
				}


			#check if id parameter exist.
			else if( isset($_GET['id'] ) )
				{
					#Check parameter action.
					if(isset($_GET['action'] ))
						{
							#check if is a asked action.
							if($_GET['action'] === "addComment")
								{
									require('controller/commentFrontend.php'); createComment($_POST['author'], $_POST['content'], $_GET['id']);
								}
							else
								{
									throw new Exception("L'action demander n'a pas pu être interpréter");
								}

						}
					
					require('controller/commentFrontend.php'); displayPostComments($_GET['id']);
						
					
				}

			else
				{
					require('controller/postFrontend.php'); postsList();
				}
		}
		catch(Exception $e)
			{
				$errorMessage = 'Erreur : '.$e->getMessage();
				require('view/errorView.php');
			}


}
