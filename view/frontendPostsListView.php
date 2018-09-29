<?php $title="Blog Jean Forteroche" ?>

<?php ob_start(); ?>

<h2>Billets : </h2>

<div id="pagination1" class="row offset-lg-5 offset-2">
<?php 

for ($i=1; $i<=$listOfPost[1]; $i++)
	{?>

		<?php if($i===$listOfPost[2])
			{?>
				
					<p> <?= $listOfPost[2] ?> </p>
				
			<?php
			}
		else
			{?>
				<a  href="index.php?page=<?= $i ?>"><?= $i ?></a>
			<?php
			}
				
	} ?>

</div>
	<?php

while($postData = $listOfPost[0]->fetch()){
	?>
	
	<article class="row">
		<div class="offset-1 col-10 ">

			<header>
					<h3> <?= htmlspecialchars($postData['title']) ?>     </h3>
			</header>

			<p>  <?= strip_tags($postData['content'], '<p><em><strong>') ?>  </p>

			<footer class="row" >	
					<p class="col-lg-4"> Mise en ligne : <?= htmlspecialchars($postData['post_date']) ?> </p>
					<p class="col-lg-4" > Dernière mise à jour : <?= htmlspecialchars($postData['last_update_date']) ?> </p>
					<a class="offset-lg-2 col-lg-2" href="index.php?id=<?= $postData['id'] ?>&amp;page=1">Commentaires</a>
			</footer>

		</div> 
	</article>
	

<?php

	}
?>
<div id="pagination2" class="row offset-lg-5 offset-2">
<?php
	for ($i=1; $i<=$listOfPost[1]; $i++)
	{
		if($i===$listOfPost[2])
			{?>
				<p> <?= $listOfPost[2] ?> </p>
			<?php
			}
		else
			{?>
				<a  href="index.php?page=<?= $i ?>"><?= $i ?></a>
			<?php
			}
	} 
?>
</div>
<?php $content= ob_get_clean();?>


<?php require('view/template.php'); ?>