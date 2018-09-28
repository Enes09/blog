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
		<a href="index.php?action=updateView&amp;postId=<?= $postData['id'] ?>&amp;page=1">Modifier</a>
		<a href="index.php?action=delete&amp;postId=<?= $postData['id'] ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le billet : <?= htmlspecialchars($postData['title']) ?>')">Supprimer</a>
	</div>

<?php
	}
?>

<h2>Commentaires :</h2>

<?php
$pageActual=0;
for ($i=1; $i<=$listComment[1]; $i++)
	{
		if($i===$listComment[2])
			{
				$pageActual=$listComment[2];
				?>
				<p> <?= $listComment[2] ?> </p>
			<?php
			}
		else
			{?>
				<a  href="index.php?action=commentsView&amp;id=<?= $_GET['id'] ?>&amp;page=<?= $i ?>"><?= $i ?></a>
			<?php
			}
	} 



while($commentsData = $listComment[0]->fetch()){
	?>

	<div style="border:solid; width: 50%; margin-top: 2%; margin-left: 10%;" >
		<h3> <?= htmlspecialchars($commentsData['author']) ?> </h3>
		<p> <?= htmlspecialchars($commentsData['content']) ?> </p>
		<p> <?= htmlspecialchars($commentsData['comment_date']) ?> </p>
		<?php 

		if($commentsData['validation']){ 
		?>
			<p>Vous avez validé ce message.</p>
			<a href="index.php?action=deleteComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le commentaire de : <?= htmlspecialchars($commentsData['author']) ?>')">Supprimer</a>
		<?php	

			}
#=== 1
		else if ($commentsData['alert']>0) 
			{
		?>			
			<p>Ce message a été signaler <?= $commentsData['alert'] ?> fois.</p>
			<a href="index.php?action=deleteComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le commentaire de : <?= htmlspecialchars($commentsData['author']) ?>')">Supprimer</a>
			<a href="index.php?action=validateComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir valider le commentaire de : <?= htmlspecialchars($commentsData['author']) ?>')">Valider</a>

		<?php
			}
		else{
			?>

			<a href="index.php?action=deleteComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le commentaire de : <?= htmlspecialchars($commentsData['author']) ?>')">Supprimer</a>
			<a href="index.php?action=validateComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir valider le commentaire de : <?= htmlspecialchars($commentsData['author']) ?>')">Valider</a>
		<?php	
		}

		?>
			
		
	</div>

<?php
	}
	for ($i=1; $i<=$listComment[1]; $i++)
	{
		if($i===$listComment[2])
			{
				$pageActual=$listComment[2];
				?>
				<p> <?= $listComment[2] ?> </p>
			<?php
			}
		else
			{?>
				<a  href="index.php?action=commentsView&amp;id=<?= $_GET['id'] ?>&amp;page=<?= $i ?>"><?= $i ?></a>
			<?php
			}
	} 
?>

<?php $content= ob_get_clean();?>

<?php require('view/template.php') ?>