<?php $title = 'Erreur'; ?>
<?php ob_start(); ?>

<h1> Erreur ! </h1>

<p> <?= $errorMessage ?> </p>


<?php ob_get_clean(); ?>
<?php require('template.php'); ?>