<?php
//hérite du fichier layout.php à la racine de app/Views/
// title dans l'onglet de la page
$this->layout('layout', ['title' => 'Créer un article']) ?>

<?php
//début du bloc main_content
$this->start('main_content'); ?>
<h2 class="text-center">Créer un article</h2>
<form class="" method="post">
  <div class="form-group">
    <label for="title">Titre :</label>
    <input type="text" class="form-control" id="title" name="title">
  </div>
  <div class="form-group">
    <label for="content">Contenu :</label>
    <textarea type="text" class="form-control" id="title" name="content"></textarea>
  </div>
  <div class="form-group">
    <label for="category">Catégories :</label>
    <input type="text" class="form-control tagsinput" id="category" name="category">
  </div>
  <button class="btn" type="submit" name="button">Publier l'article</button>
</form>

<?php
//fin du bloc
$this->stop('main_content'); ?>
