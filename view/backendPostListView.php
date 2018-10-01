<?php $title = "Billets :" ?>

<?php ob_start(); ?>
<a id="homeReturn" class="col-lg-2" href="index.php"> <i class="fas fa-arrow-left"></i>  Acceuil</a>
<h2 id="billetFrontendPostList" class="row offset-1 offset-lg-1 " >Billets : </h2>

<div id="pagination1" class="row offset-lg-5 offset-1">
<a id="arrow" href="index.php?action=postListView&amp;page=<?= pageControlMinus($postList); ?>"> < </a>
<?php 

function pageControlMinus($postList){
		if($postList[2] === 1){
			return 1;
		}
		else{
			return $postList[2]-1;
		}
	}

function pageControlPlus($postList){
		if($postList[2] === $postList[1]){
			return $postList[1];
		}
		else{
			return $postList[2]+1;
		}
	}


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
	} ?>

<a id="arrow" href="index.php?action=postListView&amp;page=<?= pageControlPlus($postList); ?>"> > </a>
</div>
	<?php


while($postData = $postList[0]->fetch()){
	?>

	<article id="backendPostLits" class="row">
		<div class="offset-1 col-10 offset-1 ">

			<header>
					<h3> <?= htmlspecialchars($postData['title']) ?>     </h3>
			</header>

			<p>  <?= strip_tags($postData['content'], '<p><em><strong>') ?>  </p>

			<footer class="row" >	
					<p class="col-lg-3"> Mise en ligne : <?= htmlspecialchars($postData['post_date']) ?> </p>
					<p class="col-lg-3" > Dernière mise à jour : <?= htmlspecialchars($postData['last_update_date']) ?> </p>
					<a class="col-lg-1 offset-lg-1" href="index.php?action=delete&amp;postId=<?= $postData['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le billet : <?= htmlspecialchars($postData['title']) ?>')">Supprimer  </a><br/>
					<a class="col-lg-1 offset-lg-1" href="index.php?action=updateView&amp;postId=<?= $postData['id'] ?>&amp;page=<?= $pageActual ?>">Modifier</a><br/>
					<a class="col-lg-1 offset-lg-1 postComment" href="index.php?action=commentsView&amp;id=<?= $postData['id'] ?>">Commentaires</a>
			</footer>

		</div> 
	</article>

<?php
	}
?>
<div id="pagination2" class="row offset-lg-5 offset-1">
<a id="arrow" href="index.php?action=postListView&amp;page=<?= pageControlMinus($postList); ?>"> < </a>

<?php
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
<a id="arrow" href="index.php?action=postListView&amp;page=<?= pageControlPlus($postList); ?>"> > </a>
</div>
<?php $content= ob_get_clean();?>


<?php require('view/template.php'); ?>