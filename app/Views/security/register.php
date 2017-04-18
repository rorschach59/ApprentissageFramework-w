<?php

//hérite du fichier layout.php à la racine de app/Views/
// title dans l'onglet de la page
$this->layout('layout', ['title' => 'Inscription']) ?>

<?php
//début du bloc main_content
$this->start('main_content'); ?>

<h2 class="text-center">Inscription</h2>
<!-- <?php if (!empty($messages)) {
     foreach($messages as $message) {
         echo '<div class="text-danger">' . $message . '</div>';

     }
 }
 ?> -->

<form class="" method="post">
  <div class="form-group <?= (isset($messages['username'])) ? 'has-error' : '' ?>">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" class="form-control" id="username" name="username" value="<?= $username;?>" >
    <?= (isset($messages['username'])) ? '<span class="help-block">' . $messages['username'] . '</span>' : '' ?>
  </div>
  <div class="form-group">
    <label for="email">Email :</label>
    <input type="email" class="form-control" id="email" name="email" value="<?= $email;?>">
  </div>
  <div class="form-group">
    <label for="password">Mot de passe :</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="form-group">
    <label for="cf_password">Confirmer le mot de passe :</label>
    <input type="password" class="form-control" id="cf_password" name="cf_password">
  </div>

  <button class="btn" type="submit" name="button">S'inscrire</button>
</form>
<?php
//fin du bloc
$this->stop('main_content'); ?>
