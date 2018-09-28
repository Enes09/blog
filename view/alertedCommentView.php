<?php $title= "Commentaires alerté : "; ?>

<?php ob_start(); ?>

<a href="index.php">Acceuil</a>

<h2>Commentaires alerté : </h2>

<?php

$pageActual=0;
for ($i=1; $i<=$alerted[1]; $i++)
	{
		if($i===$alerted[2])
			{
				$pageActual=$alerted[2];
				?>
				<p> <?= $alerted[2] ?> </p>
			<?php
			}
		else
			{?>
				<a  href="index.php?action=alertedCommentView&amp;page=<?= $i ?>"><?= $i ?></a>
			<?php
			}
	} 


while($commentsData = $alerted[0]->fetch()){
	?>

	<div style="border:solid; width: 50%; margin-top: 2%; margin-left: 10%;" >
		<h3> <?= htmlspecialchars($commentsData['author']) ?> </h3>
		<p> <?= htmlspecialchars($commentsData['content']) ?> </p>
		<p> <?= htmlspecialchars($commentsData['comment_date']) ?> </p>
		
		<?php 

		if($commentsData['validation']){ 
		?>
			<p>Vous avez validé ce message.</p>
			<a href="index.php?action=alertedCommentView&amp;delete&amp;commentId=<?= $commentsData['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le billet : <?= htmlspecialchars($commentsData['author']) ?>')">Supprimer</a>
		<?php	

			}
#=== 1
		else if ($commentsData['alert']>0) 
			{
		?>			
			<p>Ce message a été signaler <?= $commentsData['alert'] ?> fois.</p>
			<a href="index.php?action=alertedCommentView&amp;delete&amp;commentId=<?= $commentsData['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le billet : <?= htmlspecialchars($commentsData['author']) ?>')">Supprimer</a>
			<a href="index.php?action=alertedCommentView&amp;validate&amp;commentId=<?= $commentsData['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir valider le billet : <?= htmlspecialchars($commentsData['author']) ?>')">Valider</a>
		<?php
			}
		else{
			?>

			<a href="index.php?action=alertedCommentView&amp;delete&amp;commentId=<?= $commentsData['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le billet : <?= htmlspecialchars($commentsData['author']) ?>')">Supprimer</a>
			<a href="index.php?action=alertedCommentView&amp;validate&amp;commentId=<?= $commentsData['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir valider le billet : <?= htmlspecialchars($commentsData['author']) ?>')">Valider</a>
		<?php	
		}

		?>
			
	</div>
	<a href="index.php?action=commentsView&amp;id=<?= $commentsData['post_id'] ?>&amp;page=1">Voir le billet</a>

<?php
	}

$pageActual=0;
for ($i=1; $i<=$alerted[1]; $i++)
	{
		if($i===$alerted[2])
			{
				$pageActual=$alerted[2];
				?>
				<p> <?= $alerted[2] ?> </p>
			<?php
			}
		else
			{?>
				<a  href="index.php?action=alertedCommentView&amp;page=<?= $i ?>"><?= $i ?></a>
			<?php
			}
	} 
?>

<?php $content= ob_get_clean();?>

<?php require('view/template.php') ?>