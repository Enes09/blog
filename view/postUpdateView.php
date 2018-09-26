<?php $title = "Billets :" ?>

<?php ob_start(); ?>
<a href="index.php">Acceuil</a>
<h2>Billets : </h2>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=bziizowrerw8frw7u16pkbzufq9pq4whkn951ppg5tz5bnpb"></script>
<script>tinymce.init({ selector:'textarea' });</script>

<?php 

while($postData = $display->fetch()){
	?>

	

	<form method="POST" action="index.php?action=postUpdate&amp;postId=<?= $postData['id'] ?>">
	<label>Titre : <input type="text" name="updateTitle" value="<?= htmlspecialchars($postData['title']) ?>"></input></label>
		<textarea name="updateContent"> <?= htmlspecialchars($postData['content']) ?> </textarea>
		<input type="submit" name="update" value="modifier">
	</form>	

	<p> posté le : <?= htmlspecialchars($postData['post_date']) ?> </p>
	<p> Dernière date de mis à jour : <?= htmlspecialchars($postData['last_update_date']) ?> </p>

	<a href="index.php?action=delete&amp;postId=<?= $postData['id'] ?>">Supprimer</a><br/>
	<a href="index.php?action=commentsView&amp;id=<?= $postData['id'] ?>">Commentaires</a>

<?php
	}
?>


<?php $content= ob_get_clean();?>


<?php require('view/template.php'); ?>