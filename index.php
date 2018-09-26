<?php
session_start();

if(isset($_SESSION['login'])){

	if(isset($_GET['connection'] ) && $_GET['connection'] === "disconnect" )
		{
			require('controller/usersBackend.php'); disconnect();
		}

	else if (isset($_GET['connection'] ) && $_GET['connection'] === "disconnectAuto")
		{
			require('controller/usersBackend.php'); cancelAuto(); 
		}

	else if(isset($_GET['action']))
		{
			if($_GET['action']==="postCreationView")
				{
					require('controller/postBackend.php'); postCreationView();			
				}
			else if($_GET['action']==="postCreate")
				{
					require('controller/postBackend.php'); postCreate($_POST['title'], $_POST['postContent']);
				}

			else if($_GET['action']==="postListView") 
				{
					require('controller/postBackend.php'); postListView();
				}
			else if($_GET['action']==="delete" && isset($_GET['postId']))
				{	
					require('controller/postBackend.php'); postDelete($_GET['postId']);
				}
			else if($_GET['action']==="updateView" && isset($_GET['postId']))
				{
					require('controller/postBackend.php'); postView($_GET['postId']);	
				}
			else if($_GET['action']==="postUpdate")
				{
					if(isset($_POST['updateTitle'], $_POST['updateContent'], $_GET['postId']))
						{
							require('controller/postBackend.php'); postUpdate($_POST['updateTitle'], $_POST['updateContent'],  $_GET['postId']);
						}
					else
						{
							throw new Exception("Les champs demander ne sont pas complet.");
							
						}
					
				}
			else if($_GET['action']==="commentsView")
				{
					if(isset($_GET['id']))
						{
							require('controller/commentBackend.php'); commentsView($_GET['id']); 
						}
					else
						{
							throw new Exception("Nous n'avons pas retrouver le billet correspondantgg.");
							
						}
					
				}

			else if($_GET['action']==="deleteComment")
				{
					if(isset($_GET['commentId'], $_GET['id']))
						{
							require('controller/commentBackend.php'); deleteComment($_GET['commentId'], $_GET['id']);
						}
					else
						{
							throw new Exception("Nous n'avons pas pu retrouver le commentaire correspondant.");
							
						}
					
				}
			else if ($_GET['action']==="validateComment")
				{
					if(isset($_GET['commentId'], $_GET['id']))
						{
							require('controller/commentBackend.php'); validateComment($_GET['commentId'], $_GET['id']);
						}
					else
						{
							throw new Exception("Nous n'avons pas pu retrouver le commentaire correspondant.");

						}
				}
			else if ($_GET['action']==="alertedCommentView")
				{
					if(isset($_GET['delete'], $_GET['commentId']))
						{
							require('controller/commentBackend.php'); deleteAlertedComment($_GET['commentId']);
						}
					else if(isset($_GET['validate'], $_GET['commentId']))
						{
							require('controller/commentBackend.php'); validateAlertedComment($_GET['commentId']);
						}
					else
						{
							require('controller/commentBackend.php'); alertedCommentView();
						}
					
				}
		}
	else 
		{
			require('controller/usersBackend.php'); showHome();
		}
	

}


#for the automatic connection
else if(isset($_COOKIE['blogLogin'], $_COOKIE['blogPassword']))
	{
		if($_COOKIE['blogLogin'] === "JeanForteroche")
			{
				require('controller/usersBackend.php'); autoConnection($_COOKIE['blogLogin'], $_COOKIE['blogPassword']);
			}
		else
			{
				throw new Exception("La connection automatique n'a pas pu être établie.");
				
			}
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
					if($_GET['connection'] === "connect")
						{
							if (isset($_POST['login'], $_POST['password'], $_POST['auto']))
								{
									require('controller/usersBackend.php'); connection($_POST['login'], $_POST['password'], $_POST['auto']);
								}
							else if(isset($_POST['login'], $_POST['password']))
								{
									require('controller/usersBackend.php'); connection($_POST['login'], $_POST['password'], "off");
								}
							else
								{
									throw new Exception("La connection a échoué.");
								}

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
