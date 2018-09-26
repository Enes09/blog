<?php $title= "Commentaires alerté : "; ?>

<?php ob_start(); ?>

<a href="index.php">Acceuil</a>

<h2>Commentaires alerté : </h2>

<?php

while($commentsData = $alerted->fetch()){
	?>

	<div style="border:solid; width: 50%; margin-top: 2%; margin-left: 10%;" >
		<h3> <?= htmlspecialchars($commentsData['author']) ?> </h3>
		<p> <?= htmlspecialchars($commentsData['content']) ?> </p>
		<p> <?= htmlspecialchars($commentsData['comment_date']) ?> </p>
		
		<?php 

		if($commentsData['validation']){ 
		?>
			<p>Vous avez validé ce message.</p>
			<a href="index.php?action=alertedCommentView&amp;delete&amp;commentId=<?= $commentsData['id'] ?>">Supprimer</a>
		<?php	

			}
#=== 1
		else if ($commentsData['alert']>0) 
			{
		?>			
			<p>Ce message a été signaler <?= $commentsData['alert'] ?> fois.</p>
			<a href="index.php?action=alertedCommentView&amp;delete&amp;commentId=<?= $commentsData['id'] ?>">Supprimer</a>
			<a href="index.php?action=alertedCommentView&amp;validate&amp;commentId=<?= $commentsData['id'] ?>">Valider</a>
		<?php
			}
		else{
			?>

			<a href="index.php?action=alertedCommentView&amp;delete&amp;commentId=<?= $commentsData['id'] ?>">Supprimer</a>
			<a href="index.php?action=alertedCommentView&amp;validate&amp;commentId=<?= $commentsData['id'] ?>">Valider</a>
		<?php	
		}

		?>
			
	</div>
	<a href="index.php?action=commentsView&amp;id=<?= $commentsData['post_id'] ?>">Voir le billet</a>

<?php
	}
?>

<?php $content= ob_get_clean();?>

<?php require('view/template.php') ?>