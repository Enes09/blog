<?php $title = "Acceuil" ?>

<?php ob_start(); ?>

<h2 class="offset-lg-1 offset-1 homeTitle">Bienvenue Mr Forteroche</h2>

<div class="row">
<a href="index.php?action=postCreationView" class="homeLinks offset_lg-2 col-lg-10 offset-1 col-10 offset-1 ">Créer de nouveau billets</a>
<a href="index.php?action=postListView" class="homeLinks offset_lg-2 col-lg-10 offset-1 col-10 offset-1 ">Voir les billets</a>

<a href="index.php?action=alertedCommentView&amp;page=1" class="homeLinks offset_lg-2 col-lg-10 offset-1 col-10 offset-1 "  >Voir les commentaires alerté</a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php') ?>