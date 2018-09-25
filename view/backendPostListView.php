<?php $title = "Billets :" ?>

<?php ob_start(); ?>
<a href="index.php">Acceuil</a>
<h2>Billets : </h2>

<?php 

while($postData = $postList->fetch()){
	?>
	<div style="border:solid; width: 50%; margin: 2%;">
		<h3> <?= htmlspecialchars($postData['title']) ?>     </h3>
		<p>  <?= htmlspecialchars($postData['content']) ?>   </p>
		<p>  <?= htmlspecialchars($postData['post_date']) ?> </p>
		<a href="index.php?action=delete&amp;postId=<?= $postData['id'] ?>">Supprimer</a><br/>
		<a href="index.php?action=updateView&amp;postId=<?= $postData['id'] ?>">Modifier</a><br/>
		<a href="index.php?id=<?= $postData['id'] ?>">Commentaires</a>
	</div>

<?php
	}
?>

<?php $content= ob_get_clean();?>


<?= require('view/template.php'); ?>