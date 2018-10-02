<?php $title = "Billets :" ?>

<?php ob_start(); ?>
<a id="homeReturn" class="col-lg-2" href="index.php"> <i class="fas fa-arrow-left"></i>  Acceuil</a>
<h2 id="billetFrontendPostList" class="row offset-1 offset-lg-1 " >Billets : </h2>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=bziizowrerw8frw7u16pkbzufq9pq4whkn951ppg5tz5bnpb"></script>
<script>tinymce.init({ 
	selector:'textarea',
	height:"480",
	width:"90%"

 });</script>
<script type="text/javascript">

document.getElementById("header").style.marginTop="-30px";
	
	function checkUpdateForm(){

		var title = document.getElementById("title");
		var content = document.getElementById("content");

		if (title.value==="" || content.value==="")
			{
				alert("Veuillez remplir tous les champs pour modifier un billet.");
				return false;
			}
		else
			{
				return true;
			}

	}
</script>
<?php 

while($postData = $display->fetch()){
	?>


	<form method="POST" action="index.php?action=postUpdate&amp;postId=<?= $postData['id'] ?>&amp;page=<?= $_GET['page'] ?>" onsubmit="tinyMCE.triggerSave(); return checkUpdateForm()">
	<label class="row offset-lg-1 offset-1 updateText" for="title">Titre : 

			<input id="title" class=" offset-lg-3 col-lg-5 offset-1 col-10 title" type="text" name="updateTitle" value="<?= htmlspecialchars($postData['title']) ?>" required ></input></label><br/>

	<label for="content" class="row offset-lg-1 col-lg-10 offset-1 updateText" >Contenu : 

			<textarea id="content" class="contentTIny" name="updateContent" ><?=htmlspecialchars($postData['content'])?></textarea></label><br/>


			<input class="row offset-lg-11 offset-1 modify" type="submit" name="update" value="modifier">
	</form>	

	<p class="row offset-lg-1 offset-1 updateP" > posté le : <?= htmlspecialchars($postData['post_date']) ?> </p>
	<p class="row offset-lg-1 offset-1 updateP" > Dernière date de mis à jour : <?= htmlspecialchars($postData['last_update_date']) ?> </p>

	<a class="row offset-lg-1 col-lg-1 offset-1 col-4 delete" href="index.php?action=delete&amp;postId=<?= $postData['id'] ?>&amp;page=<?= $_GET['page'] ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le billet : <?= htmlspecialchars($postData['title']) ?>')">Supprimer</a><br/>
	<a class="row offset-lg-1 col-lg-1 offset-7 col-5 commentShow" href="index.php?action=commentsView&amp;id=<?= $postData['id'] ?>">Commentaires</a>

<?php
	}
?>


<?php $content= ob_get_clean();?>


<?php require('view/template.php'); ?>