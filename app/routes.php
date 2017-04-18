<?php

	$w_routes = array(
		//la ou les méthodes HTTP de la requête, le masque d'URL à associer, le nom du contrôleur et le nom de la méthode à appeler, le nom de cette route-ci
		// le point d'interrogation dit que le paramètre n'est pas obligé
		['GET', '/[i:page]?/', 'Default#home', 'home'],
		['GET|POST', '/contact/', 'Default#contact', 'contact'],

    ['GET', '/article', 'Article#index', 'article_index'],
		['GET|POST', '/article/create', 'Article#create', 'article_create'],
		['GET|POST', '/article/random', 'Article#random', 'article_random'],
		// [i:id] pour récupérer l'id de l'article que l'on veut supprimer
		['GET|POST', '/article/delete/[i:id]', 'Article#delete', 'article_delete'],
		['GET|POST', '/article/update/[i:id]', 'Article#update', 'article_update'],
		// A METTRE EN DERNIER
		['GET|POST', '/article/[i:id]', 'Article#view', 'article_view'],
		['GET|POST', '/article/categories.json', 'Article#categories', 'article_categories'],

		['GET|POST', '/register', 'Security#register', 'security_register'],
		['GET|POST', '/login', 'Security#login', 'security_login'],
		['GET|POST', '/logout', 'Security#logout', 'security_logout']
	);
