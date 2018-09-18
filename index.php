<?php
session_start();
$_SESSION['login'] = null;



if( $_SESSION['login'] !== null )
	{

		#appel le controller du backend sensé afficher le backend avec le dashbord
		#require('backend.php');

	}
else
	{
		
		#appel le controller du frontend qui lui va faire la liason entre le model et la vue correspondante
		require('frontend.php');

	}