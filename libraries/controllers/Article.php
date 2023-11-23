<?php



namespace Controllers;



class Article  extends Controller
{
   
   protected $modelName =  "\Models\Article"; 
   protected $comment;


   
    public function index() {
     

      
$articles = $this->model->findAll("created_at DESC");


/**
 * 3. Affichage
 */
$pageTitle = "Accueil";
\Renderer::render('articles/index', compact('pageTitle', 'articles'));

    }

    public function show() {
        //Mopntrer un article


        $comment = new \Models\Comment();


$article_id = null;
// Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $article_id = $_GET['id'];
}
// On peut désormais décider : erreur ou pas ?!
if (!$article_id) {
    die("Vous devez préciser un paramètre `id` dans l'URL !");
}

/**
 * 3. Récupération de l'article en question
 */
$article =  $this->model->findByOne($article_id);
/**
 * 4. Récupération des commentaires de l'article en question
 */

$commentaires = $comment->findAllWithArticle($article_id);
/**
 * 5. On affiche
 */
$pageTitle = $article['title'];
\Renderer::render('articles/show', compact('pageTitle', 'article', 'commentaires', 'article_id'));


        
        
    }

    public function delete()
    {
      


if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ?! Tu n'as pas précisé l'id de l'article !");
}

$id = $_GET['id'];

/**
 * 2. Connexion à la base de données avec PDO
 * Attention, on précise ici deux options :
 * - Le mode d'erreur : le mode exception permet à PDO de nous prévenir violament quand on fait une connerie ;-)
 * - Le mode d'exploitation : FETCH_ASSOC veut dire qu'on exploitera les données sous la forme de tableaux associatifs
 * 
 * PS : Vous remarquez que ce sont les mêmes lignes que pour l'index.php ?!
 */

 $article =  $this->model->Delete($id);

/**
 * 3. Vérification que l'article existe bel et bien
 */

if (!$article) {
    die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
}



/**
 * 5. Redirection vers la page d'accueil
 */
\Http::redirect("index.php");
    }
}