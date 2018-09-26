<?php $title = "Commenaires"; ?>

<?php ob_start(); ?>

<a href="index.php">Acceuil</a>

<h2>Billets : </h2>

<?php 

while($postData = $displayPost->fetch()){
	?>

	<div style="border:solid; width: 50%; margin: 2%;">
		<h3> <?= htmlspecialchars($postData['title']) ?>     </h3>
		<p>  <?= strip_tags($postData['content'], '<p><em><strong>') ?>   </p>
		<p> Date de mis en ligne : <?= htmlspecialchars($postData['post_date']) ?> </p>
		<p> Dernière date de mis à jour:  <?= htmlspecialchars($postData['last_update_date']) ?> </p>
		<a href="index.php?action=updateView&amp;postId=<?= $postData['id'] ?>">Modifier</a>
		<a href="index.php?action=delete&amp;postId=<?= $postData['id'] ?>">Supprimer</a>
	</div>

<?php
	}
?>

<h2>Commentaires :</h2>

<?php

while($commentsData = $listComment->fetch()){
	?>

	<div style="border:solid; width: 50%; margin-top: 2%; margin-left: 10%;" >
		<h3> <?= htmlspecialchars($commentsData['author']) ?> </h3>
		<p> <?= htmlspecialchars($commentsData['content']) ?> </p>
		<p> <?= htmlspecialchars($commentsData['comment_date']) ?> </p>
		<?php 

		if($commentsData['validation']){ 
		?>
			<p>Vous avez validé ce message.</p>
			<a href="index.php?action=deleteComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>">Supprimer</a>
		<?php	

			}
#=== 1
		else if ($commentsData['alert']>0) 
			{
		?>			
			<p>Ce message a été signaler <?= $commentsData['alert'] ?> fois.</p>
			<a href="index.php?action=deleteComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>">Supprimer</a>
			<a href="index.php?action=validateComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>">Valider</a>

		<?php
			}
		else{
			?>

			<a href="index.php?action=deleteComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>">Supprimer</a>
			<a href="index.php?action=validateComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>">Valider</a>
		<?php	
		}

		?>
			
			

	</div>

<?php
	}
?>

<?php $content= ob_get_clean();?>

<?php require('view/template.php') ?>