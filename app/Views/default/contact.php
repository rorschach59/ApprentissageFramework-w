<?php
//hérite du fichier layout.php à la racine de app/Views/
$this->layout('layout', ['title' => 'Contact'])
?>

<?php
//début du bloc main_content
$this->start('main_content'); ?>
<h1>Contactez-nous !</h1>

<?php
//fin du bloc
$this->stop('main_content'); ?>
