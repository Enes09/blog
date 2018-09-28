<?php $title = "Commentaires" ?>

<?php ob_start(); ?>

<a href="index.php">Retour aux billets</a>

<h2>Billets : </h2>


<script type="text/javascript">
	function checkCommentForm(){

		var author = document.getElementById("author");
		var content = document.getElementById("content");

		if(author.value==="" || content.value==="")
			{
				alert("Veuillez remplir tous les champs pour poster un commentaire.");
				return false;
				
			}
		else
			{
				return true;
			}
	}
</script>


<form method="post" action="index.php?action=addComment&amp;id=<?= $_GET['id'] ?>" onsubmit= "return checkCommentForm()" >
		<label>Pseudo : <input id="author" type="text" name="author"  required /></label><br/>
		<label>Message :<textarea id="content" name="content" required></textarea></label><br/>
		<input type="submit" name="send" value="Envoyer" />
</form>


<?php 
$alertedPage=0;
while($postData = $displayPost->fetch()){
	?>

	<div style="border:solid; width: 50%; margin: 2%;">
		<h3> <?= htmlspecialchars($postData['title']) ?>     </h3>
		<p>  <?= strip_tags($postData['content'], '<p><em><strong>') ?>   </p>
		<p> Date de mise en ligne : <?= htmlspecialchars($postData['post_date']) ?> </p>
		<p> Dernière mise à jour : <?= htmlspecialchars($postData['last_update_date']) ?> </p>
	</div>

<?php
	}
?>

<h2>Commentaires :</h2>

<?php

for ($i=1; $i<=$commentsList[1]; $i++)
	{
		if($i===$commentsList[2])
			{
				$alertedPage=$commentsList[2];
				?>
				<p> <?= $commentsList[2] ?> </p>
			<?php
			}
		else
			{?>
				<a  href="index.php?id=<?= $_GET['id'] ?>&amp;page=<?= $i ?>"><?= $i ?></a>
			<?php
			}
	} 


while($commentsData = $commentsList[0]->fetch()){
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

			<a href="index.php?commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>&amp;pseudo=<?= $commentsData['author'] ?>&amp;page=<?= $alertedPage ?>" id="alertMessage" onclick="return confirm('Êtes vous sûr de vouloir signaler le message de <?= htmlspecialchars($commentsData['author']) ?>')">Signaler</a>
			
		<?php

			}

		?>

	</div>

<?php
	}

	for ($i=1; $i<=$commentsList[1]; $i++)
	{
		if($i===$commentsList[2])
			{?>
				<p> <?= $commentsList[2] ?> </p>
			<?php
			}
		else
			{?>
				<a  href="index.php?id=<?= $_GET['id'] ?>&amp;page=<?= $i ?>"><?= $i ?></a>
			<?php
			}
	} 

?>

<?php $content= ob_get_clean();?>

<?php require('view/template.php') ?>