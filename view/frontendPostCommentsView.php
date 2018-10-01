<?php $title = "Commentaires" ?>

<?php ob_start(); ?>

<a class="returnPost" href="index.php"> <i class="fas fa-arrow-left"></i> Retour aux billets</a>




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




<h2 class="offset-lg-1 billet">Billet : </h2>

<?php 
$alertedPage=0;
while($postData = $displayPost->fetch()){
	?>

	<article  class="row">
		<div class="offset-1 col-10 offset-1 ">

			<header>
					<h3> <?= htmlspecialchars($postData['title']) ?>     </h3>
			</header>

			<p>  <?= strip_tags($postData['content'], '<p><em><strong>') ?>  </p>

			<footer class="row" >	
					<p class="col-lg-4"> Mise en ligne : <?= htmlspecialchars($postData['post_date']) ?> </p>
					<p class="col-lg-4" > Dernière mise à jour : <?= htmlspecialchars($postData['last_update_date']) ?> </p>
			</footer>

		</div> 
	</article>

<?php
	}
?>
<form id="commentsForm" class="offset-lg-1 col-lg-3 offset-1 col-10 offset-1 " method="post" action="index.php?action=addComment&amp;id=<?= $_GET['id'] ?>" onsubmit= "return checkCommentForm()" >
		<label>Pseudo : <br/><input id="author" type="text" name="author" required /></label><br/>
		<label>Message :<br/><textarea id="content" name="content" required></textarea></label><br/>
		<input class="offset-lg-10 offset-9" id="submitComment" type="submit" name="send" value="Envoyer" />
</form>
<h2 class="offset-lg-1 commentH2">Commentaires :</h2>

<div id="pagination1" class="row offset-lg-6 offset-3">
<a id="arrow" href="index.php?id=<?= $_GET['id'] ?>&amp;page=<?= pageControlMinus($commentsList); ?>"> < </a>
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
	
?>
<a id="arrow" href="index.php?id=<?= $_GET['id'] ?>&amp;page=<?= pageControlPlus($commentsList); ?>"> > </a>
</div>
<?php

while($commentsData = $commentsList[0]->fetch()){
	?>

	<div id="comments" class="offset-lg-3 col-lg-7 offset-1 col-10 offset-1"  >
		<div class="row">
			<h3 class="col-lg-12"> <?= htmlspecialchars($commentsData['author']) ?> </h3>
			<p  class="col-lg-12"> <?= htmlspecialchars($commentsData['content']) ?> </p>
			<p  class="col-lg-6" id="commentDate"> <?= htmlspecialchars($commentsData['comment_date']) ?> </p>
		

		<?php 

		$cookieName = "commentId".strval($commentsData['id']);

		if($commentsData['validation']){ 
		?>
			
			<p class="col-lg-6" id="validationMsg">Ce message a été validé par Jean Forteroche.</p>

		<?php	

			}
#=== 1
		else if (isset($_COOKIE[$cookieName]) && $_COOKIE[$cookieName] === $commentsData['id']) 
			{
		?>			
			<p class="col-lg-6" id="alertMsg">Vous avez signaler ce message.</p>

		<?php
			}

		else
			{

		?>

			<a class="col-lg-6" href="index.php?commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>&amp;pseudo=<?= $commentsData['author'] ?>&amp;page=<?= $alertedPage ?>" id="alertMessage" onclick="return confirm('Êtes vous sûr de vouloir signaler le message de <?= htmlspecialchars($commentsData['author']) ?>')">Signaler</a>
			
		<?php

			}

		?>
		</div>
	</div>


<?php
	}
	function pageControlMinus($commentsList){
		if($commentsList[2] === 1){
			return 1;
		}
		else{
			return $commentsList[2]-1;
		}
	}
?>
<div id="pagination2" class="row offset-lg-6 offset-3">
<a id="arrow" href="index.php?id=<?= $_GET['id'] ?>&amp;page=<?= pageControlMinus($commentsList); ?>"> < </a>
<?php
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

	function pageControlPlus($commentsList){
		if($commentsList[2] === $commentsList[1]){
			return $commentsList[1];
		}
		else{
			return $commentsList[2]+1;
		}
	}

?>
<a id="arrow" href="index.php?id=<?= $_GET['id'] ?>&amp;page=<?= pageControlPlus($commentsList); ?>"> > </a>
</div>
<?php $content= ob_get_clean();?>

<?php require('view/template.php') ?>