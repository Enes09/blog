<?php $title="Création de billet" ?>

<?php ob_start(); ?>
<a href="index.php">Acceuil</a>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=bziizowrerw8frw7u16pkbzufq9pq4whkn951ppg5tz5bnpb"></script>
 <script>tinymce.init({ selector:'textarea' });</script> 

<form method="POST" action="index.php?action=postCreate">
	<label>Titre du billet : <input type="text" name="title"/></label><br/>
	<label>Contenu du billet : <textarea name="postContent"></textarea></label><br/>
	<input type="submit" name="post" value="envoyer" />
</form>


<?php $content=ob_get_clean(); ?>

<?php require('view/template.php'); ?>