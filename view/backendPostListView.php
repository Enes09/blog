<?php $title = "Billets :" ?>

<?php ob_start(); ?>
<a href="index.php">Acceuil</a>
<h2>Billets : </h2>

<?php 

while($postData = $postList->fetch()){
	?>
	<div style="border:solid; width: 50%; margin: 2%;">
		<h3> <?= htmlspecialchars($postData['title']) ?>     </h3>
		<p>  <?= strip_tags($postData['content'], '<p><em><strong>') ?>  </p>
		<p> Date de mise en ligne : <?= htmlspecialchars($postData['post_date']) ?> </p>
		<p> Dernière mise à jour : <?= htmlspecialchars($postData['last_update_date']) ?> </p>
		<a href="index.php?action=delete&amp;postId=<?= $postData['id'] ?>">Supprimer</a><br/>
		<a href="index.php?action=updateView&amp;postId=<?= $postData['id'] ?>">Modifier</a><br/>
		<a href="index.php?action=commentsView&amp;id=<?= $postData['id'] ?>">Commentaires</a>
	</div>

<?php
	}
?>

<?php $content= ob_get_clean();?>


<?php require('view/template.php'); ?>