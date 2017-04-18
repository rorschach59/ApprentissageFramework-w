<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UserModel;

class SecurityController extends Controller
{

  // Créer un user
  public function register()
  {
    $messages = null;
    $username = null;
    $email = null;

    // Traitement du formulaire
    if (!empty($_POST)) {
      // On peut se passer de addslashes grâce au prepare de PDO
      $username = trim($_POST['username']);
      $email = trim($_POST['email']);
      $password = trim($_POST['password']);
      $cf_password = trim($_POST['cf_password']);

      // Je crée le tableau d'erreur
      $errors = [];

      // J'instancie la classe pour gérer mes articles en BDD
      $user_manager = new UserModel();

      if (  $user_manager->emailExists($email) || $user_manager->usernameExists($username)) {
      //   array_push($error, array(
      // "field" => "username",
      // "message" => "Votre nom d'utilisateur n'est pas correct"
      //   ));

        $errors['exists'] = "L'email ou le nom de d'utilisateur existent";
      }

      // Je vérifie si les champs sont vides ou que l'email n'est pas valide
      if (empty($username) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $errors['username'] = "L'email ou le nom de d'utilisateur sont vides ou non valides";
      }

      if ($password !== $cf_password) {
        $errors['password'] = "Les mots de passe ne correspondent pas";
      }

      if (empty($errors)) {
        // J'instancie le AuthentificationModel qui facilite la gestion de l'authentification des utilisateurs
        $auth_manager = new \W\Security\AuthentificationModel();

        // S'il n'y a pas d'erreurs, j'utilise la méthode insert créée par le framework insert
        $user_manager->insert([
          'username' => $username,
          'email' => $email,
          'password' => $auth_manager->hashPassword($password),
          'role' => 'admin'
        ]);

        // $messages = ['Vous êtes bien inscrit.'];
        $this->redirectToRoute('home');
      }
      else {
        $messages = $errors;
      }
    }
    // On passe dans la vue le message, l'username et l'email afin de les remettre en value des input
    $this->show('security/register', ['messages' => $messages, 'username' => $username, 'email' => $email]);
  }

  // Connecter un user
  public function login()
  {
    $messages = null;
    $username = null;

    // Traitement du formulaire
    if (!empty($_POST)) {
      // On peut se passer de addslashes grâce au prepare de PDO
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);

      // Je crée le tableau d'erreur
      $errors = [];

      // J'instancie la classe pour gérer mes articles en BDD
      $user_manager = new UserModel();
      // J'instancie le AuthentificationModel qui facilite la gestion de l'authentification des utilisateurs
      $auth_manager = new \W\Security\AuthentificationModel();

      // J'indique qur $user_id vaut $auth_manager->isValidLoginInfo($username, $password)
      $user_id = $auth_manager->isValidLoginInfo($username, $password);

      // Si le couple username/password est valide
      if ( $user_id ) {
        // find($auth_manager->isValidLoginInfo) retourne l'ID de l'utilisateur
        $user = $user_manager->find($user_id);
      }
      else {
        // Sinon on rempli le tableau d'erreur
        $errors['username'] = "L'email ou le nom de d'utilisateur sont vides ou non valides";
      }

      // S'il n'y a pas d'erreurs
      if (empty($errors)) {
        // La connexion se fait
        $auth_manager->logUserIn($user);

        // Et on redirige l'utilisateur
        $this->redirectToRoute('home');
      }
      else {
        // Sinon la variable message vaut le tableau erreur
        $messages = $errors;
      }
    }
    $this->show('security/login');
  }

  public function logout()
  {
    // J'instancie le AuthentificationModel qui facilite la gestion de l'authentification des utilisateurs
    $auth_manager = new \W\Security\AuthentificationModel();

    $auth_manager->logUserOut();

    $this->redirectToRoute('home');
  }


}
