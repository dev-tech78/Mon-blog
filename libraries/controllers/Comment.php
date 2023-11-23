<?php



namespace Controllers;

use Models\Model;


//  require_once('libraries/models/Article.php');
//  require_once('libraries/models/User.php');
//  require_once('libraries/models/Comment.php');
//  require_once('libraries/controllers/Controller.php');


class Comment   extends Controller{

 
    // protected $model;
 
    //  public function __construct()
    //  {
    
    //   $this->model =  new \Models\Comment();
    //  }

    protected $modelName = \Models\Comment::class;


  public function insert()
  {

    //$CommentSAve = new \Models\Comment();
    $ArticleFind =  new \Models\Article();

$author = null;
if (!empty($_POST['author'])) {
    $author = $_POST['author'];
}

// Ensuite le contenu
$content = null;
if (!empty($_POST['content'])) {
    // On fait quand même gaffe à ce que le gars n'essaye pas des balises cheloues dans son commentaire
    $content = htmlspecialchars($_POST['content']);
}

$article_id = null;
if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
    $article_id = $_POST['article_id'];
}

if (!$author || !$article_id || !$content) {
    die("Votre formulaire a été mal rempli !");
}

$article = $ArticleFind->findByOne($article_id);

if (!$article) {
    die("Ho ! L'article $article_id n'existe pas boloss !");
}

$this->model->Add( $author,$content,$article_id );

\Http::redirect("index.php?controller=article&task=show&id=" . $article_id);


  }

  public function delete()
  {
    //$Comment = new \ModelsComment();



if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ! Fallait préciser le paramètre id en GET !");
}

$id = $_GET['id'];



$commentaire =  $this->model->findByOne($id);
if (!$commentaire) {
    die("Aucun commentaire n'a l'identifiant $id !");
}



$article_id = $commentaire['article_id'];
$commentaire=  $this->model->Delete($id);



\Http::redirect("index.php?controller=article&task=show&id=" . $article_id);
  }

}