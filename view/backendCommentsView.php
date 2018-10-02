<?php $title = "Commenaires"; ?>

<?php ob_start(); ?>

<a id="homeReturn" class="col-lg-12"  href="index.php?action=alertedCommentView&amp;page=1"> <i class="fas fa-arrow-left"></i>  Commentaires Alerté</a>
<a id="postReturn" class="row offset-lg-10 col-lg-1 offset-6 col-6" href="index.php?action=postListView">Liste des billets</a>

<h2 id="billetFrontendPostList" class="row offset-1 offset-lg-1 " >Billets : </h2>

<script type="text/javascript"> document.getElementById("header").style.marginTop="-30px"; </script>

<?php 

while($postData = $displayPost->fetch()){
	?>



	<article id="backendPostLits" class="row">
		<div class="offset-1 col-10 offset-1 ">

			<header>
					<h3> <?= htmlspecialchars($postData['title']) ?>     </h3>
			</header>

			<p>  <?= strip_tags($postData['content'], '<p><em><strong>') ?>  </p>

			<footer class="row" >	
					<p class="col-lg-4"> Mise en ligne : <?= htmlspecialchars($postData['post_date']) ?> </p>
					<p class="col-lg-4" > Dernière mise à jour : <?= htmlspecialchars($postData['last_update_date']) ?> </p>
					<a class="col-lg-1 offset-lg-1" href="index.php?action=updateView&amp;postId=<?= $postData['id'] ?>&amp;page=1">Modifier</a>
					<a class="offset-lg-1 col-lg-1" href="index.php?action=delete&amp;postId=<?= $postData['id'] ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le billet : <?= htmlspecialchars($postData['title']) ?>')">Supprimer</a>
			</footer>

		</div> 
	</article>

<?php
	}
?>

<h2 id="alertedCommentsTitle" class="offset-lg-1 " >Commentaires :</h2>

<div id="pagination1" class="row offset-lg-5 offset-4">
<a id="arrow" href="index.php?action=commentsView&amp;id=<?= $_GET['id'] ?>&amp;page=<?= pageControlMinus($listComment); ?>"> < </a>

<?php

function pageControlMinus($listComment){
		if($listComment[2] === 1){
			return 1;
		}
		else{
			return $listComment[2]-1;
		}
	}

function pageControlPlus($listComment){
		if($listComment[2] === $listComment[1]){
			return $listComment[1];
		}
		else{
			return $listComment[2]+1;
		}
	}



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

?>
<a id="arrow" href="index.php?action=commentsView&amp;id=<?= $_GET['id'] ?>&amp;page=<?= pageControlPlus($listComment); ?>"> > </a>
</div>

<?php

while($commentsData = $listComment[0]->fetch()){
	?>

	<div id="comments" class="comments offset-lg-1 col-lg-8 offset-1 col-10 offset-1"  >
		<div class=" alertedComment">
			<h3 class="col-lg-12"> <?= htmlspecialchars($commentsData['author']) ?> </h3>
			<p  class="col-lg-12"> <?= htmlspecialchars($commentsData['content']) ?> </p>
			<p  class="col-lg-12" id="commentDate"> <?= htmlspecialchars($commentsData['comment_date']) ?> </p>
		<?php 

		if($commentsData['validation']){ 
		?>
			<p class="col-lg-12" >Vous avez validé ce message.</p>
			<a class="col-lg-12"  href="index.php?action=deleteComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le commentaire de : <?= htmlspecialchars($commentsData['author']) ?>')">Supprimer <i class="fas fa-times"></i> </a>
		<?php	

			}

		else if ($commentsData['alert']>0) 
			{
		?>			
			<p class="col-lg-12" >Ce message a été signaler <?= $commentsData['alert'] ?> fois.</p>
			<a class="col-lg-12" href="index.php?action=deleteComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le commentaire de : <?= htmlspecialchars($commentsData['author']) ?>')">Supprimer <i class="fas fa-times"></i> </a>
			<a class="col-lg-12" href="index.php?action=validateComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir valider le commentaire de : <?= htmlspecialchars($commentsData['author']) ?>')">Valider <i class="fas fa-check"></i> </a>

		<?php
			}

		else{
			?>

			<a class="col-lg-12" href="index.php?action=deleteComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le commentaire de : <?= htmlspecialchars($commentsData['author']) ?>')">Supprimer <i class="fas fa-times"></i> </a>
			<a class="col-lg-12" href="index.php?action=validateComment&amp;commentId=<?= $commentsData['id'] ?>&amp;id=<?= $_GET['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir valider le commentaire de : <?= htmlspecialchars($commentsData['author']) ?>')">Valider <i class="fas fa-check"></i> </a>
		<?php	
		}

		?>
			
		</div>
	</div>


<?php
	}?>

<div id="pagination2" class="row offset-lg-5 offset-4">
<a id="arrow" href="index.php?action=commentsView&amp;id=<?= $_GET['id'] ?>&amp;page=<?= pageControlMinus($listComment); ?>"> < </a>

<?php	for ($i=1; $i<=$listComment[1]; $i++)
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

<a id="arrow" href="index.php?action=commentsView&amp;id=<?= $_GET['id'] ?>&amp;page=<?= pageControlPlus($listComment); ?>"> > </a>

</div>

<?php $content= ob_get_clean();?>

<?php require('view/template.php') ?>