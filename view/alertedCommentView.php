<?php $title= "Jean Forteroche"; ?>

<?php ob_start(); ?>

<a id="homeReturn" class="col-lg-2" href="index.php"> <i class="fas fa-arrow-left"></i>  Acceuil</a>

<h2 id="alertedCommentsTitle" class="offset-lg-1 offset-1 col-10 offset-1 ">Commentaires alerté : </h2>

<div id="pagination1" class="row offset-lg-5 offset-4">
<a id="arrow" href="index.php?action=alertedCommentView&amp;page=<?= pageControlMinus($alerted); ?>"> < </a>
<?php

function pageControlMinus($alerted){
		if($alerted[2] === 1){
			return 1;
		}
		else{
			return $alerted[2]-1;
		}
	}

function pageControlPlus($alerted){
		if($alerted[2] === $alerted[1]){
			return $alerted[1];
		}
		else{
			return $alerted[2]+1;
		}
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
<a id="arrow" href="index.php?action=alertedCommentView&amp;page=<?= pageControlPlus($alerted); ?>"> > </a>
</div>
<?php

while($commentsData = $alerted[0]->fetch()){
	?>

	<div id="comments" class="comments offset-lg-1 col-lg-8 offset-1 col-10 offset-1" >
		<div class=" alertedComment">
			<h3 class="col-lg-12"> <?= htmlspecialchars($commentsData['author']) ?> </h3>
			<p  class="col-lg-12"> <?= htmlspecialchars($commentsData['content']) ?> </p>
			<p  class="col-lg-12" id="commentDate"> <?= htmlspecialchars($commentsData['comment_date']) ?> </p>
		<?php 

		if($commentsData['validation']){ 
		?>
		
			<p class="col-lg-3 ">Vous avez validé ce message. <i class="fas fa-check"></i> </p>
			<a class="col-lg-3 " href="index.php?action=alertedCommentView&amp;delete&amp;commentId=<?= $commentsData['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le billet : <?= htmlspecialchars($commentsData['author']) ?>')">Supprimer <i class="fas fa-times"></i> </a>
		
		<?php	

			}
#=== 1
		else if ($commentsData['alert']>0) 
			{
		?>			
			<p class="col-lg-12">Ce message a été signaler <?= $commentsData['alert'] ?> fois.</p>
			<a class="col-lg-2" href="index.php?action=alertedCommentView&amp;delete&amp;commentId=<?= $commentsData['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le billet : <?= htmlspecialchars($commentsData['author']) ?>')">Supprimer <i class="fas fa-times"></i> </a>
			<a class="col-lg-2" href="index.php?action=alertedCommentView&amp;validate&amp;commentId=<?= $commentsData['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir valider le billet : <?= htmlspecialchars($commentsData['author']) ?>')">Valider <i class="fas fa-check"></i> </a>
		<?php
			}
		else{
			?>

			<a class="col-lg-1" href="index.php?action=alertedCommentView&amp;delete&amp;commentId=<?= $commentsData['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le billet : <?= htmlspecialchars($commentsData['author']) ?>')">Supprimer <i class="fas fa-times"></i> </a>
			<a class="col-lg-3" href="index.php?action=alertedCommentView&amp;validate&amp;commentId=<?= $commentsData['id'] ?>&amp;page=<?= $pageActual ?>" onclick="return confirm('Êtes vous sûr de vouloir valider le billet : <?= htmlspecialchars($commentsData['author']) ?>')">Valider <i class="fas fa-check"></i> </a>
		<?php	
		}

		?>
		<a id="showPost" class="row offset-lg-1 col-lg-2 offset-lg-9 offset-1 col-10 offset-1 offset-md-8 col-md-4 showPost" href="index.php?action=commentsView&amp;id=<?= $commentsData['post_id'] ?>&amp;page=1">Voir le billet <i class="fas fa-arrow-circle-right"></i> </a>
		
	</div>
	
</div>


<?php
	}
?>
<div id="pagination2" class="row offset-lg-5 offset-4">
<a id="arrow" href="index.php?action=alertedCommentView&amp;page=<?= pageControlMinus($alerted); ?>"> < </a>

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
?>

<a id="arrow" href="index.php?action=alertedCommentView&amp;page=<?= pageControlPlus($alerted); ?>"> > </a>
</div>

<?php $content= ob_get_clean();?>

<?php require('view/template.php') ?>