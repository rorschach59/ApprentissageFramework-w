<?php

//hérite du fichier layout.php à la racine de app/Views/
// title dans l'onglet de la page
$this->layout('layout', ['title' => 'Connexion']) ?>

<?php
//début du bloc main_content
$this->start('main_content'); ?>

<h2 class="text-center">Connexion</h2>
<!-- <?php if (!empty($messages)) {
     foreach($messages as $message) {
         echo '<div class="text-danger">' . $message . '</div>';

     }
 }
 ?> -->

<form class="" method="post">
  <div class="form-group">
    <label for="username">Votre nom d'utilisateur ou votre email :</label>
    <input type="text" class="form-control" id="username" name="username" value="" >
    <!-- <?= (isset($messages['username'])) ? '<span class="help-block">' . $messages['username'] . '</span>' : '' ?> -->
  </div>
  <div class="form-group">
    <label for="password">Mot de passe :</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>

  <button class="btn" type="submit" name="button">Se connecter</button>
</form>
<?php
//fin du bloc
$this->stop('main_content'); ?>
