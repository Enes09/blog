<?php $title="Blog Jean Forteroche" ?>

<?php ob_start(); ?>

<h2>Billets : </h2>

<?php 

for ($i=1; $i<=$listOfPost[1]; $i++)
	{
		if($i===$listOfPost[2])
			{?>
				<p> <?= $listOfPost[2] ?> </p>
			<?php
			}
		else
			{?>
				<a  href="index.php?page=<?= $i ?>"><?= $i ?></a>
			<?php
			}
	} 

while($postData = $listOfPost[0]->fetch()){
	?>
	<div style="border:solid; width: 50%; margin: 2%;">
		<h3> <?= htmlspecialchars($postData['title']) ?>     </h3>
		<p>  <?= strip_tags($postData['content'], '<p><em><strong>') ?>  </p>
		<p> Date de mise en ligne : <?= htmlspecialchars($postData['post_date']) ?> </p>
		<p> Dernière mise à jour : <?= htmlspecialchars($postData['last_update_date']) ?> </p>
		<a href="index.php?id=<?= $postData['id'] ?>&amp;page=1">Commentaires</a>
	</div>

<?php

	}

	for ($i=1; $i<=$listOfPost[1]; $i++)
	{
		if($i===$listOfPost[2])
			{?>
				<p> <?= $listOfPost[2] ?> </p>
			<?php
			}
		else
			{?>
				<a  href="index.php?page=<?= $i ?>"><?= $i ?></a>
			<?php
			}
	} 
?>

<?php $content= ob_get_clean();?>


<?php require('view/template.php'); ?>