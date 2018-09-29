<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Blog Jean Forteroche</title>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">	
    	<link rel="stylesheet" type="text/css" href="public/frontend.css">

    </head>
	<body >

		<header>
			<?=  $title; ?>
			<img src="public/image/headerAlaska.jpg">	
		</header>

		<?= $content; ?>

		<footer class="row">


					<?php
						if(!isset($_SESSION['login']))
						{
					?>
					<input id="button" type="button" name="show" value="Connexion" class="offset-lg-10 offset-8" />

					<div class="row offset-1 offset-lg-1">
					<p class="offset-lg-1 offset-1">Tel : 01 02 03 04 05</p>
					<p class="offset-lg-1 offset-1">mail : jeanforteroche@serveur.com</p>
					</div>

					<script
					  src="https://code.jquery.com/jquery-3.3.1.min.js"
					  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
					  crossorigin="anonymous">
					 </script>

					<script type="text/javascript">

						document.getElementById("button").addEventListener('click', function(){
							document.getElementById("form").style.display = "block";
							document.getElementById("button").style.display = "none";
						})

						$(document).mouseup(function(e) 
						{
						    var container = $("#form");
						    var button = $("#button");

						    if (!container.is(e.target) && container.has(e.target).length === 0) 
						    {
						        container.hide();
						        button.show();
						    }
						});

						function checkConnectionForm(){

							var login = document.getElementById("login");
							var password = document.getElementById("password");

							if(login.value==="" || password.value==="")
								{
									alert("Veuillez remplir tous les champs pour vous connecter");
									return false;
								}
							else
								{
									return true
								}
						} 
						
					</script>

					

					<form id="form" style="display: none; width: 500px; height: 100px; border: solid; text-align: center;" method="POST" action="index.php?connection=connect" onsubmit="return checkConnectionForm()">
							<label>
								Login : 
								<input id="login" type="text" name="login" required/><br/>
							</label>

							<label>
								Mot de passe : 
								<input id="password" type="password" name="password" required />
							</label>

							
							<label>Connexion automatique : <input type="checkbox" name="auto" id="oui" /></label>
							
							

							<input type="submit" name="Envoyer" value="Connexion">
					</form>

					<?php
						}
						else
						{
					?>

					<a href="index.php?connection=disconnectAuto">Déconnexion</a>


					<?php		
						}

					?>


		</footer>

	</body>
</html>