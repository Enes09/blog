<?php $title = "Acceuil" ?>

<?php ob_start(); ?>

<h2>Bienvenue Mr <?= $_SESSION['login'] ?></h2>

<a href="index.php?action=postCreationView" style="border: solid; width: 100px; height: 100px; float: left; margin: 20px;" >Créer de nouveau billets</a>
<a href="index.php?action=postListView" style="border: solid; width: 100px; height: 100px; float: left; margin: 20px;" >Voir les billets</a>

<a href="index.php?action=alertedCommentView" style="border: solid; width: 100px; height: 100px; float: left; margin: 20px;" >Voir les commentaires alerter</a>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php') ?>