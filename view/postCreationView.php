<?php $title="Création de billet" ?>

<?php ob_start(); ?>
<a href="index.php">Acceuil</a>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=bziizowrerw8frw7u16pkbzufq9pq4whkn951ppg5tz5bnpb"></script>
 <script>tinymce.init({ selector:'textarea' });</script> 


<div id="alertMessage" style="display: none;"><p>Vous devez remplir tous les champs.</p></div>

<form action="index.php?action=postCreate" method="POST" onsubmit="tinyMCE.triggerSave(); return checkCreationForm()">
	<label>Titre du billet : <input id="title" type="text" name="title" required /></label><br/>
	<label>Contenu du billet : <textarea id="content" name="postContent" ></textarea></label><br/>
	<input type="submit" name="post" value="envoyer" />
</form>

<script type="text/javascript">
	function checkCreationForm(){
		var title = document.getElementById("title");
		var content = document.getElementById("content");

		if(title.value==="" || content.value==="")
			{
				var alert = document.getElementById("alertMessage");
				alert.style.display="block";
				setTimeout(function(){
					alert.style.display="none";
				}, 2000); 
				return false;

			}
		else
			{
				return true;
			}

	}

</script>

<?php $content=ob_get_clean(); ?>

<?php require('view/template.php'); ?>