<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\ArticleModel;
use \Model\CategoryModel;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	 // Par défaut on se trouve sur la page 1
	public function home($page = 1)
	{
		$article_manager = new ArticleModel();

		// J'instancie la classe pour gérer mes catégories en BDD
		$category_manager = new CategoryModel();

		$article_by_page = 12;
		// Je compte le nombre d'articles dans mon blog
		$total_articles = count( $article_manager->findAll() );

		$offset = ( $page -1 ) * $article_by_page;

		// nombre de pages en arrondissant au supérieur
		$max_pages = ceil( $total_articles / $article_by_page );

		// Récupére les auteurs des articles
		$articles = $article_manager->findAllJoinAuthor('', 'ASC', $article_by_page, $offset);

		// Je récupére toutes les catégories en BDD (SELECT * FROM category) ($category_manager est une variable que nous définissons, on peut mettre ce que l'on veut)
		$categories = $category_manager->countArticleIncategory();

		// Récupére les derniers articles, grâce à la colonne created_at, orderBy decroissant et on en affiche que 3
		$last_articles = $article_manager->findAll('created_at', 'DESC', 3);


		$this->show('default/home', [
			'articles' => $articles,
			'page' => $page,
			'max_pages' => $max_pages,
			'last_articles' => $last_articles,
			'categories' => $categories,
			'category_manager' => $category_manager
		]);

	}


	public function contact()
	{
		//traiter le formulaire contact ici...

		$this->show('default/contact');
	}

}
