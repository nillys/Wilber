<?php

/**
 * This file contains class and functions to treat with comments and linked forms 
 * 
 * Ce fichier contient des classes et des fonctions permetant la bonne gestion de 
 * datas et de formulaire . il permet avec facilité de gerer en 
 * toute simplicité l'ajout , l'affichage de data par exemple. 
 *
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Mathieu <dwwm-mathieu@mode83.onmicrosoft.com>
 */



/**
 * article
 * 
 * A class that contain property and method related to article 
 * 
 * 
 */
// si le fichier de config n'a pas été créé on redirige l'utilisateur vers la page approprié
if(!file_exists("config.php")){
    header('location: start.php');
  }
require "config.php";

class comment extends data
{

    protected $db_table_name = "comment";


    public function db_table_name()
    {
        return $this->db_table_name;
    }

    /**
     * generate_form
     *
     * @param  mixed $type
     * @param  int $variant Choose wich of form variant generate 
     * @return void
     */
    public static function generate_form(int $variant = 1)
    {
?>
        <div id="form_container" >
            <div id="section_form">

                <div>
                    <h2>Espace commentaire</h2> <button id="button_erase_form" style="" title="Effacer le formulaire" class="oi oi-x btn" onclick="erase()"></button>
                </div>

                <form action="" method="post">

                    <div class="form-group">
                        <label for="nom">Nom / Pseudo :</label>
                        <input class="form-control" type="text" value="<?php if (!empty($_POST['comment_author'])) {
                                                                            echo $_POST['comment_author'];
                                                                        } ?>" name="comment_author" id="author" placeholder="votre nom">
                    </div>
                    <div class="form-group">
                        <label for="nom">Rentrer un titre : </label>
                        <input class="form-control" type="text" value="<?php if (!empty($_POST['comment_title'])) {
                                                                            echo $_POST['comment_title'];
                                                                        } ?>" name="comment_title" id="title" placeholder="Le titre du data">
                    </div>
                    <div class="form-group">
                        <label for="category">choisissez une catégorie : </label>
                        <select class="form-control" id="category" name="comment_category">
                            <option>Le blog</option>
                            <option>Les développeur</option>
                            <option>Autres</option>
                        </select>
                    </div>
                    <textarea id="body" name="comment_body" class="form-control" placeholder="Entrez votre data ici"><?php if (!empty($_POST['comment_body'])) {
                                                                                                                            echo $_POST['comment_body'];
                                                                                                                        } ?></textarea>
                    <br>
                    <button class="btn btn-success class=" type="submit">Envoyer! </button>
                </form>


            </div>

        </div>
    <?php
        return "comment";
    }
} // COMMENT

class article extends data
{

    protected $db_table_name = "aticle";


    public function db_table_name()
    {
        return $this->db_table_name;
    }

    /**
     * generate_form
     *
     * @param  mixed $type
     * @param  int $variant Choose wich of form variant generate 
     * @return void
     */
    public static function generate_form(int $variant = 1)
    {
    ?>
        <div id="form_container" class="d-flex">
            <div id="section_form">

                <div class="d-flex">
                    <h2>Espace ARCTICLE</h2> <button id="button_erase_form" style="" title="Effacer le formulaire" class="oi oi-x btn" onclick="erase()"></button>
                </div>

                <form action="" method="post">

                    <div class="form-group">
                        <label for="nom">Nom / Pseudo :</label>
                        <input class="form-control" type="text" value="<?php if (!empty($_POST['article_author'])) {
                                                                            echo $_POST['article_author'];
                                                                        } ?>" name="article_author" id="author" placeholder="votre nom">
                    </div>
                    <div class="form-group">
                        <label for="nom">Rentrer un titre : </label>
                        <input class="form-control" type="text" value="<?php if (!empty($_POST['article_title'])) {
                                                                            echo $_POST['article_title'];
                                                                        } ?>" name="article_title" id="title" placeholder="Le titre du data">
                    </div>
                    <div class="form-group">
                        <label for="category">choisissez une catégorie : </label>
                        <select class="form-control" id="category" name="article_category">
                            <option>Le blog</option>
                            <option>Les développeur</option>
                            <option>Autres</option>
                        </select>
                    </div>
                    <textarea id="body" name="article_body" class="form-control" placeholder="Entrez votre data ici"><?php if (!empty($_POST['article_body'])) {
                                                                                                                            echo $_POST['article_body'];
                                                                                                                        } ?></textarea>
                    <br>
                    <button class="btn btn-success class=" type="submit">Envoyer! </button>
                </form>


            </div>

        </div>
        <?php
        return "article";
    }
} // article

class contact extends data
{

    protected $db_table_name = "contact";


    public function db_table_name()
    {
        return $this->db_table_name;
    }

    /**
     * generate_form
     *
     * @param  mixed $type
     * @param  int $variant Choose wich of form variant generate 
     * @return void
     */
    public static function generate_form(int $variant = 1)
    {
    ?>
        <div id="form_container">
            <div id="section_form">

                <div class="d-flex">
                    <h2>Espace COMMENTAIRE</h2> <button id="button_erase_form" style="" title="Effacer le formulaire" class="oi oi-x btn" onclick="erase()"></button>
                </div>

                <form action="" method="post">

                    <div class="form-group">
                        <label for="nom">Nom / Pseudo :</label>
                        <input class="form-control" type="text" value="<?php if (!empty($_POST['comment_author'])) {
                                                                            echo $_POST['comment_author'];
                                                                        } ?>" name="comment_author" id="author" placeholder="votre nom">
                    </div>
                    <div class="form-group">
                        <label for="nom">Rentrer un titre : </label>
                        <input class="form-control" type="text" value="<?php if (!empty($_POST['comment_title'])) {
                                                                            echo $_POST['comment_title'];
                                                                        } ?>" name="comment_title" id="title" placeholder="Le titre du data">
                    </div>
                    <div class="form-group">
                        <label for="category">choisissez une catégorie : </label>
                        <select class="form-control" id="category" name="comment_category">
                            <option>Le blog</option>
                            <option>Les développeur</option>
                            <option>Autres</option>
                        </select>
                    </div>
                    <textarea id="body" name="comment_body" class="form-control" placeholder="Entrez votre data ici"><?php if (!empty($_POST['comment_body'])) {
                                                                                                                            echo $_POST['comment_body'];
                                                                                                                        } ?></textarea>
                    <br>
                    <button class="btn btn-success class=" type="submit">Envoyer! </button>
                </form>


            </div>

        </div>
    <?php
        return "contact";
    }
} // contact


/**
 * data
 * 
 * A simple comment class that group all usefull attribut and method related to such object
 * Une classe toute simple qui regroupe toutes les méthodes et attribut propres cet élément
 * 
 */

class data
{


    private $title, $author, $body, $category, $date_post;

    public function __construct($title_or_data, $author = "", $body = "", $category = "", $date_post = "")
    {

        if (is_string($title_or_data)) {
            $this->setTitle($title_or_data);
            $this->setAuthor($author);
            $this->setBody($body);
            $this->setCategory($category);
            $this->setDate_post($date_post);
        } elseif (is_array($title_or_data)) {
            $this->setTitle($title_or_data['title']);
            $this->setAuthor($title_or_data['author']);
            $this->setBody($title_or_data['body']);
            $this->setCategory($title_or_data['category']);
            $this->setDate_post($title_or_data['date_post']);
        }
    }

    public function setTitle(string $title)
    {

        $this->title = $title;
    }
    public function setAuthor(string $author)
    {

        $this->author = $author;
    }
    public function setBody(string $body)
    {

        $this->body = $body;
    }
    public function setCategory(string $category)
    {
        $this->category = $category;
    }
    public function setDate_post($date_post)
    {

        $this->date_post = $date_post;
    }
    public function setTable($db_table_name)
    {

        $this->db_table_name = $db_table_name;
    }

    public function title()
    {
        return $this->title;
    }
    public function author()
    {
        return $this->author;
    }
    public function body()
    {
        return $this->body;
    }
    public function category()
    {
        return $this->category;
    }
    public function date_post()
    {
        return $this->date_post;
    }
    public function db_table_name()
    {
        return $this->db_table_name;
    }
} // data

class dataManager
{
    //le Pdo fournit par la méthode constructrice
    private $_db;
    // list des objets récupéré de la base de donné et stocké ici pour l'éxécution du programme
    private $list_item_data = ["comment" => array(), "article" => array(), "contact" => array()];

    /**
     * current_post
     *
     * @var mixed stock the $_POST 
     */
    private $current_post, $processing_dumb;
    // current_treatment_mode recoit en paramètre une string "comment" "article" "contact" 
    private $current_treatment_mode = array();

    private $debugmode;
    // Fournir à la classe un objet PDO 
    public function __construct(PDO $db, $current_post, $debugmode = 0)
    {
        $this->_db = $db;
        $this->current_post = $current_post;
        if ($debugmode) {
            var_dump($current_post);
        }


        $this->debugmode = $debugmode;
    }

    public function add_treatment($mode)
    {
        if (!empty($this->current_post)) {
            // phase de traitement qui prend en paramêtre le post et le paramètre renvoyé par le formulaire pour savoir le type de traitement a effectuer (article , commentaire,etc)
            $this->processing_dumb = $this->processing_form($this->current_post, $mode);
        }
    }

    // FONCTION EXTERNE
    public function add(comment $data)
    {
        // switch ($data) {
        //     case comment::class:

        //         break;
        // }
        $q = $this->_db->prepare('INSERT INTO ' . $data->db_table_name() . '(author,title,body,category) VALUES(:author,:title,:body,:category)');
        $q->bindValue(':title', $data->title());
        $q->bindValue(':author', $data->author());
        $q->bindValue(':body', $data->body());
        $q->bindValue(':category', $data->category());

        $q->execute();
    }

    public function pull($table)
    {
        // Selectionner la table qui corespond aux dernier mode !!!
        $q = $this->_db->prepare('SELECT * FROM ' .$table. '');
        $q->execute();


        while ($result = $q->fetch(PDO::FETCH_ASSOC)) {

            $this->list_item_data["comment"][] = new data($result);

            // var_dump($result);
            // foreach ($result as $key => $value) {
            //     // echo $key . ' : ' . $value . ' | ';



            // }

        }
        if ($this->debugmode == true) {
            var_dump($this->list_item_data["comment"]);
        }
    }

    public function show_comment($key = 0)
    {

        // $this->pull();

        if (is_int($key)) {
        ?>
            <div class="comment_container">
                <div class="comment_title"><?= $this->list_item_data["comment"][$key]->title(); ?></div>
                <div class="comment_header">
                    <div class="comment_author"><?= '<span class="oi oi-person"></span> ' . $this->list_item_data["comment"][$key]->author(); ?></div>
                    <div class="comment_date"><?= "le : " . $this->list_item_data["comment"][$key]->date_post(); ?></div>
                </div>

                <div class="comment_body"><?= $this->list_item_data["comment"][$key]->body(); ?></div>
            </div>
        <?php
        }
    } // MANAGER data

    public function show_all_comment()
    {
        if (empty($this->list_item_data["comment"])) {
            $this->pull("comment");
        }
        echo '<div class="show_comment_container">';
        foreach ($this->list_item_data["comment"] as $value) {
        ?>
            <div class="comment_container">
                <div class="comment_title"><?= $value->title(); ?></div>
                <div class="comment_header">
                    <div class="comment_author"><?= '<span class="oi oi-person"></span> ' . $value->author(); ?></div>
                    <div class="comment_date"><?= "le : " . $value->date_post(); ?></div>
                </div>

                <div class="comment_body"><?= $value->body(); ?></div>
            </div>

<?php
        }
        echo '</div>';
    }

    public function processing_form($current_post, $treatment_type)
    {
        // while processing , errors finded are stored inside this array / Pendant le traitement les érreurs seront stocké dans cet tableau
        $errors = array();
        
        switch ($treatment_type) {

            case "comment":
                // if debug mod enabled then show / si le mode débug est activé alors afficher : 
                if ($this->debugmode) {
                    echo "This is what's inside SUPER GLOBAL POST Ceci est le contenu de la variable SUPER GLOBAL POST : " . var_dump($_POST);
                }
                
                // Starting testing phase on the content of object _POST / Début des tests sur l'envoi POST 
                if ($current_post['comment_author'] and strlen($current_post['comment_author']) > 1  and strlen($current_post['comment_author']) < 30 and preg_match('/^[a-z0-9A-Z_é]+$/', $current_post['comment_author'])) {

                    if ($current_post['comment_title'] and strlen($current_post['comment_title']) >= 5 and strlen($current_post['comment_title']) < 45) {
                        if (empty($current_post['comment_body']) or strlen($current_post['comment_body']) > 300 and strlen($current_post['comment_author']) <= 5) {
                            $errors['comment_body'] = "Veuillez rentrer un commentaire d'une longueur inférieur à 300 caractère les champs vides ne sont pas accepté";
                        }
                    } else {
                        $errors['comment_title'] = 'Veuillez rentrer un <span style="text-decoration:underline">titre</span> valide et d\'une longeur inférieur à 45 caractère';
                    }
                } else {
                    $errors['comment_author'] = "Veuillez rentrer un nom d'utilisateur valide";
                }
                break;

            case "article":
                // if debug mod enabled then show / si le mode débug est activé alors afficher : 
                if ($this->debugmode) {
                    echo "This is what's inside SUPER GLOBAL POST Ceci est le contenu de la variable SUPER GLOBAL POST : " . var_dump($_POST);
                }

                // Starting testing phase on the content of object _POST / Début des tests sur l'envoi POST 
                if ($current_post['article_author'] and strlen($current_post['article_author']) > 1  and strlen($current_post['article_author']) < 30 and preg_match('/^[a-z0-9A-Z_é]+$/', $current_post['article_author'])) {

                    if ($current_post['article_title'] and strlen($current_post['article_title']) >= 5 and strlen($current_post['article_title']) < 45) {
                        if (empty($current_post['article_body']) or strlen($current_post['article_body']) > 300 and strlen($current_post['article_author']) <= 5) {
                            $errors['article_body'] = "Veuillez rentrer un data d'une longueur inférieur à 300 caractère les champs vides ne sont pas accepté";
                        }
                    } else {
                        $errors['article_title'] = 'Veuillez rentrer un <span style="text-decoration:underline">titre</span> d\'une longeur inférieur à 45 caractère';
                    }
                } else {
                    $errors['article_author'] = "Veuillez rentrer un nom d'utilisateur valide";
                }
                break;

            case "contact":
                // if debug mod enabled then show / si le mode débug est activé alors afficher : 
                if ($this->debugmode) {
                    echo "This is what's inside SUPER GLOBAL POST Ceci est le contenu de la variable SUPER GLOBAL POST : " . var_dump($_POST);
                }

                // Starting testing phase on the content of object _POST / Début des tests sur l'envoi POST 
                if ($current_post['contact_author'] and strlen($current_post['contact_author']) > 1  and strlen($current_post['contact_author']) < 30 and preg_match('/^[a-z0-9A-Z_é]+$/', $current_post['contact_author'])) {

                    if ($current_post['contact_title'] and strlen($current_post['contact_title']) >= 5 and strlen($current_post['contact_title']) < 45) {
                        if (empty($current_post['contact_body']) or strlen($current_post['contact_body']) > 300 and strlen($current_post['contact_author']) <= 5) {
                            $errors['contact_body'] = "Veuillez rentrer un data d'une longueur inférieur à 300 caractère les champs vides ne sont pas accepté";
                        }
                    } else {
                        $errors['contact_title'] = 'Veuillez rentrer un <span style="text-decoration:underline">titre</span> d\'une longeur inférieur à 45 caractère';
                    }
                } else {
                    $errors['contact_author'] = "Veuillez rentrer un nom d'utilisateur valide";
                }
                break;
        }






        //If no errors founded , starting the storage process / Si $errors est vide alors on entame la phase de stockage des données
        if (empty($errors)) {

            // Let's create a first instance of comment class / on créer un objet data à partir des données envoyées . 
            switch ($treatment_type) {
                
                case "comment":
         
                    $current_data = new comment($current_post['comment_title'], $current_post['comment_author'], $current_post['comment_body'], $current_post['comment_category']);
                    break;
                case "article":
                    $current_data = new article($current_post['article_title'], $current_post['article_author'], $current_post['article_body'], $$current_post['article_category']);
                    break;
                case "contact":
                    $current_data = new contact($current_post['contact_title'], $current_post['contact_author'], $current_post['contact_body'], $$current_post['contact_category']);
                    break;
            }

            // Then we use "add" method of gestionnaire_data to add a new comment to the bdd / puis nous utilisons la méthode "add" pour ajouter un nouvel objet à notre bdd
            $this->add($current_data);
            $errors = "no_errors";
            // if debug mod enabled then show / si le mode débug est activé alors afficher : 
        } elseif ($this->debugmode) {
            echo '<pre>' . var_dump($errors) . '</pre>';
        }

        return $errors;
    }

    public function show_processing_message()
    {

        if ($this->debugmode) {
            echo "This is what's treatment of form sended / Voici le renvoi de la procédure traitement du formulaire : " . var_dump($this->processing_dumb);
        }

        if ($this->processing_dumb == "no_errors") {
            echo '
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong> Felicitation votre data a bien été enregistré</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
        } elseif (!empty($this->processing_dumb)) {

            foreach ($this->processing_dumb as $value) {
                echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>' . $value . '</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
            }
        }
    }
}