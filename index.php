<?php

// require_once('libraries/datbase.php');
// require_once('libraries/utils.php');
// require_once('libraries/models/Article.php');
// require_once('libraries/models/User.php');

// //$users = new User();
// //$usersModel = $users->findAll();
// $model = new Article();
// $articles = $model->findAll("created_at DESC");



// /**
//  * 3. Affichage
//  */
// $pageTitle = "Accueil";
// render('articles/index', compact('pageTitle', 'articles'));

require_once('libraries/autoload.php');
//$controller = new \Controllers\Article();
\Application::processe();
//$controller->index();