<?php $title = "Commentaires" ?>

<?php ob_start(); ?>

<a href="index.php">Retour aux billets</a>

<h2>Billets : </h2>

<form method="post" action="index.php?action=addComment&amp;id=<?= $_GET['id'] ?>">
		<label>Pseudo : <input type="text" name="author"/></label><br/>
		<label>Message :<textarea name="content"></textarea></label><br/>
		<input type="submit" name="send" value="Envoyer" />
</form>


<?php 

while($postData = $displayPost->fetch()){
	?>

	<div style="border:solid; width: 50%; margin: 2%;">
		<h3> <?= htmlspecialchars($postData['title']) ?>     </h3>
		<p>  <?= htmlspecialchars($postData['content']) ?>   </p>
		<p>  <?= htmlspecialchars($postData['post_date']) ?> </p>
	</div>

<?php
	}
?>

<h2>Commentaires :</h2>

<?php

while($commentsData = $commentsList->fetch()){
	?>

	<div style="border:solid; width: 50%; margin-top: 2%; margin-left: 10%;" >
		<h3> <?= htmlspecialchars($commentsData['author']) ?> </h3>
		<p> <?= htmlspecialchars($commentsData['content']) ?> </p>
		<p> <?= htmlspecialchars($commentsData['comment_date']) ?> </p>

		<?php 

		$cookieName = "commentId".strval($commentsData['id']);

		if($commentsData['validation']){ 
		?>
			
			<p>Ce message a été validé par Jean Forteroche.</p>

		<?php	

			}
#=== 1
		else if (isset($_COOKIE[$cookieName]) && $_COOKIE[$cookieName] === $commentsData['id']) 
			{
		?>			
			<p>Vous avez signaler ce message.</p>

		<?php
			}

		else
			{

		?>
			<a href="index.php?commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>&amp;pseudo=<?= $commentsData['author'] ?>">Signaler</a>

		<?php

			}

		?>

	</div>

<?php
	}
?>

<?php $content= ob_get_clean();?>

<?= require('view/template.php') ?>