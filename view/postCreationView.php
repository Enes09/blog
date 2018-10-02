<?php $title="Création de billet" ?>

<?php ob_start(); ?>
<a id="homeReturn" class="col-lg-2" href="index.php"> <i class="fas fa-arrow-left"></i>  Acceuil</a>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=bziizowrerw8frw7u16pkbzufq9pq4whkn951ppg5tz5bnpb"></script>
 <script>tinymce.init({ selector:'textarea', height:"480", width:"90% "});</script> 


<div id="alertMessage" style="display: none;"><p>Vous devez remplir tous les champs.</p></div>

<form action="index.php?action=postCreate" method="POST" onsubmit="tinyMCE.triggerSave(); return checkCreationForm()">
	<label class="row offset-lg-1 offset-1 updateText">Titre : <input class=" offset-lg-3 col-lg-5 offset-1 col-10 title" id="title" type="text" name="title" required /></label><br/>
	<label class="row offset-lg-1 col-lg-10 offset-1 updateText">Contenu : <textarea class="contentTIny" id="content" name="postContent" ></textarea></label><br/>
	<input class="row offset-lg-11 offset-1 modify" type="submit" name="post" value="envoyer" />
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