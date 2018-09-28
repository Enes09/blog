<?php $title = "Billets :" ?>

<?php ob_start(); ?>
<a href="index.php">Acceuil</a>
<h2>Billets : </h2>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=bziizowrerw8frw7u16pkbzufq9pq4whkn951ppg5tz5bnpb"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<script type="text/javascript">
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
	<label>Titre : <input id="title" type="text" name="updateTitle" value="<?= htmlspecialchars($postData['title']) ?>" required ></input></label><br/>
		<label>Contenu : <textarea id="content" name="updateContent" ><?=htmlspecialchars($postData['content'])?></textarea></label>
		<input type="submit" name="update" value="modifier">
	</form>	

	<p> posté le : <?= htmlspecialchars($postData['post_date']) ?> </p>
	<p> Dernière date de mis à jour : <?= htmlspecialchars($postData['last_update_date']) ?> </p>

	<a href="index.php?action=delete&amp;postId=<?= $postData['id'] ?>&amp;page=<?= $_GET['page'] ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le billet : <?= htmlspecialchars($postData['title']) ?>')">Supprimer</a><br/>
	<a href="index.php?action=commentsView&amp;id=<?= $postData['id'] ?>">Commentaires</a>

<?php
	}
?>


<?php $content= ob_get_clean();?>


<?php require('view/template.php'); ?>