<?= $title = "Home" ?>

<?php ob_start(); ?>

<h2>Bienvenue Mr <?= $_SESSION['login'] ?></h2>

<a href="index.php?" style="border: solid; width: 100px; height: 100px; float: left; margin: 20px;" >Créer de nouveau billets</a>
<a href="index.php?" style="border: solid; width: 100px; height: 100px; float: left; margin: 20px;" >Voir les billets</a>
<a href="index.php?" style="border: solid; width: 100px; height: 100px; float: left; margin: 20px;" >Modifier les billets</a>
<a href="index.php?" style="border: solid; width: 100px; height: 100px; float: left; margin: 20px;" >Voir les commentaires alerter</a>
<a href="index.php?" style="border: solid; width: 100px; height: 100px; float: left; margin: 20px;" >Voir les commentaires</a>

<a href="index.php?connection=disconnect">Deconnexion</a>

<?php $content = ob_get_clean(); ?>

<?= require('view/template.php') ?>