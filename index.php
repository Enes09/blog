<?php

if( isset($_GET['id']) )
	{

		if(isset($_GET['action'] ))
			{

				if($_GET['action'] === "addComment")
					{

					require('controller/commentFrontend.php'); createComment($_POST['author'], $_POST['content'], $_GET['id']);
					}

				else if($_GET['action'] === "alert")
					{
						require('controller/commentFrontend.php'); alertComment($_GET['id']);
					}
			}
						
			

		require('controller/commentFrontend.php'); displayPostComments($_GET['id']);
	}

else
	{
		require('controller/postFrontend.php'); postsList();
	}



