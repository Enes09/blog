<?php $title = "Billets :" ?>

<?php ob_start(); ?>
<a href="index.php">Acceuil</a>
<h2>Billets : </h2>

<?php 
$pageActual=0;
for ($i=1; $i<=$postList[1]; $i++)
	{
		if($i===$postList[2])
			{
				$pageActual= $postList[2];
				?>

				<p> <?= $postList[2] ?> </p>
			<?php
			}
		else
			{?>
				<a  href="index.php?action=postListView&amp;page=<?= $i ?>"><?= $i ?></a>
			<?php
			}
	} 


while($postData = $postList[0]->fetch()){
	?>
	<div style="border:solid; width: 50%; margin: 2%;">
		<h3> <?= htmlspecialchars($postData['title']) ?>     </h3>
		<p>  <?= strip_tags($postData['content'], '<p><em><strong>') ?>  </p>
		<p> Date de mise en ligne : <?= htmlspecialchars($postData['post_date']) ?> </p>
		<p> Dernière mise à jour : <?= htmlspecialchars($postData['last_update_date']) ?> </p>

		<a href="index.php?action=delete&amp;postId=<?= $postData['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le billet : <?= htmlspecialchars($postData['title']) ?>')">Supprimer</a><br/>
		<a href="index.php?action=updateView&amp;postId=<?= $postData['id'] ?>&amp;page=<?= $pageActual ?>">Modifier</a><br/>
		<a href="index.php?action=commentsView&amp;id=<?= $postData['id'] ?>">Commentaires</a>
		
	</div>

<?php
	}

	for ($i=1; $i<=$postList[1]; $i++)
	{
		if($i===$postList[2])
			{?>
				<p> <?= $postList[2] ?> </p>
			<?php
			}
		else
			{?>
				<a  href="index.php?action=postListView&amp;page=<?= $i ?>"><?= $i ?></a>
			<?php
			}
	} 
?>

<?php $content= ob_get_clean();?>


<?php require('view/template.php'); ?>