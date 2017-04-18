<?php

// title dans l'onglet de la page
$this->layout('layout', ['title' => 'Liste des articles']) ?>

<?php
//début du bloc main_content
$this->start('main_content'); ?>
  <h2 class="text-center">Liste de nos articles</h2>

  <td><a class="btn btn-primary" href="<?= $this->url('article_create'); ?>">Créer un article</a></td>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Contenu</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($articles as $article) : ?>
      <tr>
        <td><?= $article['id']; ?></td>
        <td><?= $article['title']; ?></td>
        <td><?= $article['content']; ?></td>
        <td>
          <a class="btn btn-primary" href="<?= $this->url('article_update', ['id' => $article['id'] ] ); ?>">Modifier</a>
          <a class="btn btn-danger" href="<?= $this->url('article_delete', ['id' => $article['id'] ] ); ?>">Supprimer</a>
      </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

<?php
//fin du bloc
$this->stop('main_content'); ?>
