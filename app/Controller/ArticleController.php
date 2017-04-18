<?php

namespace Controller;

use \W\Controller\Controller;
// Pour pouvoir utiliser les model
use \Model\ArticleModel;
use \Model\CategoryModel;
use \Model\ArticleCategoryModel;

class ArticleController extends Controller
{
  // Affiche la page d'accueil des articles
  public function index()
  {

    // Défini que cette page est accessible juste à l'admin
    $this->allowTo('admin');

    // J'instancie la classe pour gérer mes articles en BDD
    $article_manager = new ArticleModel();

    // Je récupére tous les articles en BDD (SELECT * FROM article) ($article_manager est une variable que nous définissons, on peut mettre ce que l'on veut)
    $articles = $article_manager->findAll();

    // J'injecte la variable articles dans ma vue
    $this->show('article/index', ['articles' => $articles]);
  }

  // Créer un article
	public function create()
	{
    // Défini que cette page est accessible juste à l'admin
    $this->allowTo('admin');

		// Traitement du formulaire
		if (!empty($_POST)) {
			$title = $_POST['title'];
			$content = $_POST['content'];
      // Pour récupérer chaque valeur en une string dans un tableau et non une string entière avec toutes les valeurs
			$categories = explode(',', $_POST['category']);

			// J'instancie la classe pour gérer mes articles en BDD
			$article_manager = new ArticleModel();

			// Je vérifie si les champs sont vides
			if (!empty($title) && !empty($content) && !empty($categories)) {

				// S'ils ne sont pas vides, j'utilise la méthode insert créée par le framework insert pour ajouter un article
				$article_insered = $article_manager->insert([
					'title' => $title,
					'content' => $content,
          // Récupére l'ID de l'utilisateur connecté
          'author_id' => $this->getUser()['id']
				]);

        // Ajouter une catégorie, il faut ajouter la catégorie après l'article pour récupérer l'id de l'article
        $category_manager = new CategoryModel();
        $category_article_manager = new ArticleCategoryModel();

        // foreach afin de pouvoir lire le tableau
        foreach ($categories as $category_name) {

          // Cherche les catégories (pour ne pas ajouter 10 fois les mêmes catégories) dans la table category grâce au CategoryModel
          // Le @ permet de ne pas afficher les erreurs
        $category = @$category_manager->search(['name' => $category_name])[0];

          // Si la catégorie n'existe pas, je la créée
          if (!$category) {

            // $article_insered['id'] récupéré l'id de l'article fraichement ajouté
            // ATTENTION : IL faut rajouter une colonne id dans article_category
            $category = $category_manager->insert(['name' => $category_name]);
          }
          // Sert à lier l'article avec sa catégorie
          $category_article_manager->insert(['id_category' => $category['id'], 'id_article' => $article_insered['id']]);
        }
			}
		}
		$this->show('article/create');
	}

  // Remplir la base de données
  public function random()
  {
    // Défini que cette page est accessible juste à l'admin
    $this->allowTo('admin');

    // Je "démarre" faker
    $faker = \Faker\Factory::create('fr_FR');

    // J'instancie la classe pour gérer mes articles en BDD
    $article_manager = new ArticleModel();

    for ($i = 0; $i < 100; $i++) {
      $article_manager->insert([
        // Génere une phrase aléatoire
        'title' => $faker->sentence(),
        // Génere un texte aléatoire
        'content' => $faker->realText(),
        // Génére une date aléatoire entre avril 2016 et 2017
        'created_at' => $faker->dateTimeBetween('-1 year')->format('Y-m-d H:i:s')
      ]);
    }
  }

  // Supprimer un article // Ne pas oublier $id pour récupérer l'id de l'article
  public function delete($id)
  {
    // Défini que cette page est accessible juste à l'admin
    $this->allowTo('admin');

    // J'instancie la classe pour gérer mes articles en BDD
    $article_manager = new ArticleModel();

    // Je supprime l'article
    $article_manager->delete($id);

    // Après la suppression je redirige l'utilisateur vers la liste des articles
    $this->redirectToRoute('article_index');
  }

  // Mettre à jour un article
  public function update($id)
  {
    // Défini que cette page est accessible juste à l'admin
    $this->allowTo('admin');

    // J'instancie la classe pour gérer mes articles en BDD
    $article_manager = new ArticleModel();

    // Va chercher l'article grâce à son ID
    $article = $article_manager->find($id);

    // Traitement du formulaire
    if (!empty($_POST)) {
      $id = $article['id'];
      $title = $_POST['title'];
      $content = $_POST['content'];
      // Récupére les catégories sous forme de tableau
      $categories = explode( ',', $_POST['category'] );

    // Je vérifie si les champs sont vides
    if (!empty($title) && !empty($content)) {

        // Je récupére tous les articles en BDD (SELECT * FROM article)
        // S'ils ne sont pas vides, j'utilise la méthode update créée par le framework et je définis que la variable $article vaut l'update
        $article = $article_manager->update([
          'title' => $title,
          'content' => $content,
        ], $id);
        $category_manager = new CategoryModel();
        $article_category_manager = new ArticleCategoryModel();
        // On supprime toutes les catégories associées à cet article
        $article_category_manager->deleteByArticle($id);
        // Ajout des catégories et liens entre ces catégories et l'article
        foreach ($categories as $category_name) {
          $category = @$category_manager->search(['name' => $category_name])[0]; // SELECT * FROM category WHERE category_name = 'a';
          if (!$category) { // Si la catégorie n'existe pas, je la créée
            $category = $category_manager->insert(['name' => $category_name]); // On insère chacune des catégories saisies en bdd
          }
          $article_category_manager->insert(['id_category' => $category['id'], 'id_article' => $article['id']]); // On insère en bdd le lien entre l'article et chacune des catégories
        }
      }
    }

    $article = $article_manager->findWithCategories($id); // Je vais chercher un article dans la bdd par son article
    // J'injecte la variable article dans ma vue
    $this->show('article/update', ['article' => $article]);
  }

  // Afficher un seul article

  public function view($id)
  {

    // J'instancie la classe pour gérer mes articles en BDD
    $article_manager = new ArticleModel();

    // Va chercher l'article grâce à son ID
    $article = $article_manager->find($id);

    $this->show('article/view', ['article' => $article]);
  }

  public function categories()
  {
    // J'instancie la classe pour gérer mes catégories en BDD
    $category_manager = new CategoryModel();

    // Je récupére toutes les catégories en BDD (SELECT * FROM category) ($category_manager est une variable que nous définissons, on peut mettre ce que l'on veut)
    $categories = $category_manager->findAll();
    $this->showJson($categories);
  }



}
