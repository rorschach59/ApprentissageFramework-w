<?php

// title dans l'onglet de la page
$this->layout('layout', ['title' => 'Mise à jour de l\'article']) ?>

<?php
//début du bloc main_content
$this->start('main_content'); ?>
  <h2 class="text-center">Mise à jour de l'article</h2>

  <form class="" method="post">
    <div class="form-group">
      <label for="title">Titre :</label>
      <input type="text" class="form-control" id="title" name="title" value="<?= $article['title']; ?>">
    </div>
    <div class="form-group">
      <label for="content">Contenu :</label>
      <textarea type="text" class="form-control" id="content" name="content"><?= $article['content']; ?></textarea>
    </div>
    <div class="form-group">
      <label for="category">Catégories :</label>
      <input class="form-control" name="category" type="text" value="<?php echo $article['categories']; ?>" data-role="tagsinput">
   </div>
    <button class="btn" type="submit" name="button">Modifier l'article</button>
  </form>
<?php
//fin du bloc
$this->stop('main_content'); ?>
