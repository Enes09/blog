<?php $title= "error"; ?>

<?php ob_start() ?>

<strong>Erreur</strong>
<p><?= $errorMessage; ?></p>

<a id="homeReturn" class="col-lg-2" href="index.php"> <i class="fas fa-arrow-left"></i>  Acceuil</a>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
