<?php $title="Blog Jean Forteroche" ?>

<?php ob_start(); ?>

<h2>Billets : </h2>

<?php 

while($postData = $listOfPost->fetch()){
	?>
	<div style="border:solid; width: 50%; margin: 2%;">
		<h3> <?= htmlspecialchars($postData['title']) ?>     </h3>
		<p>  <?= htmlspecialchars($postData['content']) ?>   </p>
		<p>  <?= htmlspecialchars($postData['post_date']) ?> </p>
		<a href="index.php?id=<?= $postData['id'] ?>">Commentaires</a>
	</div>

<?php
	}
?>

<?php $content= ob_get_clean();?>


<?= require('view/template.php'); ?>