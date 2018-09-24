<?php $title= "error"?>

<?php ob_start() ?>

<strong>Erreur</strong>
<p><?= $errorMessage; ?></p>

<a href="index.php">page d'accueil</a>

<?php $content = ob_get_clean(); ?>

<?= require('template.php'); ?>
