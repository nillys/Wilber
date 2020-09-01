<?php

/**
 * This file contains class and functions to treat with comments and linked forms 
 * 
 * Ce fichier contient des classes et des fonctions permetant de disposer d'objet préconçu permetant de gérer facilement de dispositif comme des formulaires et des articles etc
 * 
 *
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Mathieu <dwwm-mathieu@mode83.onmicrosoft.com>
 */

use function PHPSTORM_META\type;

/**
 * article
 * 
 * A class that contain property and method related to article 
 * 
 * 
 */
// si le fichier de config n'a pas été créé on redirige l'utilisateur vers la page approprié
if (!file_exists("config.php")) {
    header('location: WB_start.php');
}
require "config.php";

// La classe abstraite servant de base aux différents modèles de données
require "WB_data.php";

// Les classes de données pour l'instant chacune des classes enfants contient les formulaires associé / 
require "WB_data_comment.php";
require "WB_data_article.php";
require "WB_data_contact.php";

// Une classe regroupant des méthodes utiles divers et variés trouvé sur le net ou conçu par moi même
require "WB_Toolbox.php";
// Un fichier contenant toutes les informations sur la version de Wilber en cours , et d'autres détails
include "WB_about.php";


class dataManager
{
    //le Pdo fournit par la méthode constructrice
    private $_db;
    // list des objets récupéré de la base de donné et stocké ici quand besoin d'êtres utilisé par d'autres fonctions
    public $list_item_data = ["comment" => array(), "article" => array(), "contact" => array()];

    // La variable super global $_POST est absorbé par la classe c'est un choix . 
    private $current_post;

    // Si cette variable est positive alors partout dans l'éxécution du code les infos de débuggage s'afficheront.
    private $debugmode;

    // GETTER

    public function list_item_data()
    {
        return $this->list_item_data;
    }

    public function __construct(PDO $pdo, $current_post, $debugmode = 0)
    {
        $this->current_post = $current_post;

        if ($debugmode) {
            var_dump($current_post);
        }

        $this->_db = $pdo;
        $this->debugmode = $debugmode;
    }


    // Cette fonction initie le procéssus de traitement des données qui est le suivant : CONTROL -> AJOUT / MODIFIER -> AFFICHER 
    // La variable $mode indique au procéssus de traitement le type d'information qui est en train d'être traiter
    // Le mode est fournit par le formulaire qui est traité . la fonction generate form renvoit cette information après avoir généré le formulaire
    public function add_treatment($mode)
    {
        // Si $_POST contient une valleur ayant le titre de la catégorie qu'on veut traiter alors on lance le traitement sur cette catégorie .
        // Cela permet de lancer un traitement de façon modulable .  

        if (!empty($this->current_post[$mode . "_author"])) {
            // phase de traitement qui prend en paramêtre le post et le paramètre renvoyé par le formulaire pour savoir le type de traitement a effectuer (article , commentaire,etc)

            $this->processing_form($this->current_post, $mode);
        }
    }


//====================================================================================================================================//
// PARTIE FONCTION LIEES A LA BASE DE DONNEES
        //Les fonctions pour envoyer et recevoir des données depuis la base de donnée
        //-----------------------------------------------------------------------------------------------------------------------------
        //-----------------------------------------------------------------------------------------------------------------------------
        //-----------------------------------------------------------------------------------------------------------------------------

    // Fonction intéligente qui detecte et rentre des données dans la base de donnée 
    // Elle prend en entrée un objet de donnée (type : article , commentaire, etc)
    public function add($data_received)
    {
        // Traitement approprié au type d'objet (article , commentaire , contact etc)


        $q = $this->_db->prepare('INSERT INTO ' . $data_received->db_table_name() . $data_received->db_table_configuration);

        // Partie Commune
        // Affection des paramètres commun aux objet data
        $q->bindValue(':title', $data_received->title());
        $q->bindValue(':author', $data_received->author());
        $q->bindValue(':body', $data_received->body());
        $q->bindValue(':category', $data_received->category());

        // Partie Particulière
        // Cette fonction est chargé d'éxecuter les parties de requettes propres aux objets traité qui dispose de paramètres suplémentaires 
        if (method_exists($data_received, "custom_request_data_parameters")) {
            $data_received->custom_request_data_parameters($q, $data_received);
        }


        $q->execute();
    }

    public function modify($data_received, $id)
    {

        $q = $this->_db->prepare('UPDATE ' . $data_received->db_table_name() . ' SET ' . $data_received->db_table_update . ' WHERE id = :id');

        // Partie Commune
        // Affection des paramètres commun aux objet data
        $q->bindValue(':title', $data_received->title());
        $q->bindValue(':author', $data_received->author());
        $q->bindValue(':body', $data_received->body());
        $q->bindValue(':category', $data_received->category());
        $q->bindValue(':id', $id);

        // Partie Particulière
        // Cette fonction est chargé d'éxecuter les parties de requettes propres aux objets traité qui dispose de paramètres suplémentaires 
        if (method_exists($data_received, "custom_request_data_parameters")) {
            $data_received->custom_request_data_parameters($q, $data_received);
        }

        $q->execute();
    }

    // Cette fonction hydrate le tableau de donnée
    public function pull($table)
    {
        // Selectionner la table qui corespond aux dernier mode !!!
        // Desc signifie inverser l'ordre de trie

        $q = $this->_db->prepare('SELECT * FROM ' . $table . ' ORDER BY id DESC');
        $q->execute();

        switch ($table) {
            case "comment":
                while ($result = $q->fetch(PDO::FETCH_ASSOC)) {
                    $this->list_item_data[$table][] = new comment($result);
                }
                break;
            case "article":

                while ($result = $q->fetch(PDO::FETCH_ASSOC)) {
                    $this->list_item_data[$table][] = new article($result);
                }
                break;
            case "contact":
                while ($result = $q->fetch(PDO::FETCH_ASSOC)) {
                    $this->list_item_data[$table][] = new contact($result);
                }
                break;
        }
        // Ici l'objet pdo est converti en tableau car l'objet data prend un tableau en entré


        if ($this->debugmode == true) {
            echo '<div class="debug_source_item"><strong>DEBUG_WB_Fonction : PULL <br></strong>Affichage du tableau remplit par la fonction à partir de la base de donnée  <br><em>NOTE : PULL est appelé une seul fois dans show_all_comment</em></div>';
            echo '<pre class="debug_vardump">';
            var_dump($this->list_item_data[$table]);
            echo '</pre>';
        }
    }

    static public function pull_item_from_db($table, $id)
    {

        require "config.php";


        $q = $pdo->prepare('SELECT * FROM ' . $table . ' WHERE id = ? ');
        $q->execute([$id]);

        $result = $q->fetch();

        return $result;
    }

//====================================================================================================================================//
// PARTIE AFFICHAGE FRONT DES DONNEES 
        // ARTICLE , COMMENTAIRE , CONTACT
        //-----------------------------------------------------------------------------------------------------------------------------\\
        //-----------------------------------------------------------------------------------------------------------------------------\\

     // COMMENT // AFFICHER UN SEUL COMMENTAIRE
    //-----------------------------------------------------------------------------------------------------------------------------\\
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
    } 


    // ALL COMMENT // AFFICHER TOUT LES COMMENTAIRES
    //-----------------------------------------------------------------------------------------------------------------------------\\
    public function show_all_comment()
    {
        if (empty($this->list_item_data["comment"])) {
            $this->pull("comment");
        }
        echo '<div class="show_comment_container">';
        foreach ($this->list_item_data["comment"] as $value) {
        ?>
            <div class="comment_container">
                <div class="comment_title_container">
                    <div class="comment_title"><?= $value->title(); ?></div>
                    <a title="Suprimer le commentaire ceci est ireverssible" href="Wb_sql_treatment.php?comment_del_id=<?=$value->id();?>&url_origin=<?php echo strtok($_SERVER['REQUEST_URI'], '?')?>"><span class="oi oi-x"></span></a>
                </div>
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

     // ALL ARTICLE // AFFICHER TOUTES LES VIGNETTES ARTICLES
    //-----------------------------------------------------------------------------------------------------------------------------\\
    public function show_all_article_thumbnail()
    {
        if (empty($this->list_item_data["article"])) {
            $this->pull("article");
        } else {
        }

        echo '<div class="thumbnail_show_article_container">';
        foreach ($this->list_item_data["article"] as $key => $value) {
        ?>

            <div class="thumbnail_article_container">
                <a href="WB_show_articles.php?position_article=<?= $key; ?>">
                    <div class="thumbnail_article_img_thumbnail" style="background-image: url('<?= $value->article_picture1_name; ?>')">
                        <div title="<?= $value->title(); ?>" class="thumbnail_article_title"><?= substr($value->title(), 0, 40) . '...'; ?></div>
                        <div class="thumbnail_article_header">
                            <div class="thumbnail_article_author"><?= '<span class="oi oi-person"></span> ' . $value->author(); ?></div>
                            <div class="thumbnail_article_date"><?= "le : " . $value->date_post(); ?></div>
                        </div>
                    </div>
                </a>
                <div class="thumbnail_article_container_body">


                    <div class="thumbnail_article_body"><?= $value->body(); ?></div>
                </div>
                <div class="thumbnail_article_footer">

                    <a class="button edit_button" href="<?= strtok($_SERVER['REQUEST_URI'], '?') . "?article_id=" . $value->id(); ?>">
                        <div title="Modifier l'article">Modifier</div>
                    </a>

                    <a class="button delete_button" href="WB_sql_treatment.php?article_del_id=<?= $value->id(); ?>&url_origin=<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>&folder_adress=<?php if (!empty($value->article_picture1_name)) {
                                                                                                                                                                                                    print_r(explode('/', $value->article_picture1_name)[2]);
                                                                                                                                                                                                } ?>">
                        <div title="Supprimer l'article (ireversible)">Suprimer</div>
                    </a>


                </div>
            </div>

        <?php
        }
        echo '</div>';
    }

     // ARTICLE // AFICHER UN ARTICLE
    //-----------------------------------------------------------------------------------------------------------------------------\\
    public function show_an_article()
    {
        if (isset($_GET['position_article'])) {


            if (empty($this->list_item_data["article"])) {
                $this->pull("article");
            }
        ?>

            <div class="show_article_container">
                <!-- style="background-image: url('<?= $this->list_item_data["article"][$_GET['position_article']]->article_picture1_name; ?>')" -->

                <div class="article_container">

                    <div class="article_title"><?= $this->list_item_data["article"][$_GET['position_article']]->title(); ?></div>
                    <div class="article_header">
                        <div class="article_author"><?= '<span class="oi oi-person"></span>' . ' : ' . $this->list_item_data["article"][$_GET['position_article']]->author(); ?></div>
                        <div class="article_date"><?= '<span class="oi oi-timer"></span>' . " le : " . $this->list_item_data["article"][$_GET['position_article']]->date_post(); ?></div>
                    </div>

                    <div class="article_container_body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="article_img1" src="<?= $this->list_item_data["article"][$_GET['position_article']]->article_picture1_name; ?>" alt="article_picture1">
                                </div>
                                <div class="col-md-8">
                                    <div class="article_body"><?= $this->list_item_data["article"][$_GET['position_article']]->body(); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="article_">

                    </div>
                </div>
            </div>


        <?php
        }
    }

//====================================================================================================================================//
    // PARTIE ANNALYSE D'ERREUR DANS LES DIFFENTS TYPE DE FORMULAIRES
    // while processing , errors finded are stored inside this array / Pendant le traitement les érreurs seront stocké dans cet tableau
    //-----------------------------------------------------------------------------------------------------------------------------\\
    //-----------------------------------------------------------------------------------------------------------------------------\\
    public function processing_form($current_post, $treatment_type)
    {

        

        $errors = array();

        switch ($treatment_type) {


            // COMMENT
            //-----------------------------------------------------------------------------------------------------------------------------\\
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
                break; // FIN ANNALYSE FORMULAIRE COMMENTAIRE


            // ARTICLE
            //-----------------------------------------------------------------------------------------------------------------------------\\
            case "article":
                // if debug mod enabled then show / si le mode débug est activé alors afficher : 
                if ($this->debugmode) {
                    echo "This is what's inside SUPER GLOBAL POST Ceci est le contenu de la variable SUPER GLOBAL POST : " . var_dump($_POST);
                }
                if ($current_post['article_title'] and strlen($current_post['article_title']) >= 5 and strlen($current_post['article_title']) < 200) {
                    // Starting testing phase on the content of object _POST / Début des tests sur l'envoi POST 
                    if ($current_post['article_author'] and strlen($current_post['article_author']) > 1  and strlen($current_post['article_author']) < 80 and preg_match('/^[a-z0-9A-Z_é]+$/', $current_post['article_author'])) {

                        if (empty($current_post['article_body'])) {
                            $errors['article_body'] = "Veuillez rentrer un corps d'article d'une longueur inférieur à 1500 caractère les champs vides ne sont pas accepté";
                        }
                    } else {
                        $errors['article_author'] = "Veuillez rentrer un nom d'utilisateur valide";
                    }
                } else {
                    $errors['article_title'] = 'Veuillez rentrer un <span style="text-decoration:underline">titre</span> d\'une longeur inférieur à 200 caractère';
                }


                // PARTIE ANNALYSE EVENTUEL FICHIER 
                //-----------------------------------------------------------------------------------------------------------------------------\\
                // $_FILES ['name'] = Nom du fichier uploadé
                // ['size'] = taille du fichier uploadé
                // ['extension']
                // ['tmp_name'] = nom du dossier temporaire ou le fichier est stocké

                $tmp_article_picture_1 = "";
                $tmp_article_picture_2 = "";
                $tmp_article_picture_3 = "";

                // Traitement fichier 1
                if (isset($_FILES['article_picture1']) and !empty($_FILES['article_picture1']['name'])) {
                    $max_size = 2097152;
                    $valid_extensions = array('jpg', 'jpeg', 'gif', 'png');
                    if ($_FILES['article_picture1']['size'] <= $max_size) {
                        $extension_file_uploaded = strtolower(substr(strrchr($_FILES['article_picture1']['name'], '.'), 1));
                        if (in_array($extension_file_uploaded, $valid_extensions)) {
                            $WB_image_directory_path = "Posts_images/Article/" . "WB_article_" . toolbox::clean($current_post['article_title']) . "/1." . $extension_file_uploaded;
                            // Créer le dossier si celui ci n'éxiste pas . 
                            if (!is_dir("Posts_images/Article/" . "WB_article_" . toolbox::clean($current_post['article_title']) . "/")) {
                                mkdir("Posts_images/Article/" . "WB_article_" . toolbox::clean($current_post['article_title']) . "/");
                            }

                            $resultat = move_uploaded_file($_FILES['article_picture1']['tmp_name'], $WB_image_directory_path);
                            if ($resultat) {
                                // Le chemin d'accès au fichier qui sera transmis à la base de donnée
                                $tmp_article_picture_1 = $WB_image_directory_path;
                            } else {
                                $errors['article_picture1'] = "Erreur durant le transfert de votre fichier";
                            }
                        } else {
                            $errors['article_picture1'] = "L'extension de votre image doit être jpg , jpeg, png, gif";
                        }
                    } else {
                        $errors['article_picture1'] = "La taille de votre image est supérieur à 2mo";
                    }
                }

                // traitement fichier 2
                if (isset($_FILES['article_picture2']) and !empty($_FILES['article_picture2']['name'])) {
                    $max_size = 2097152;
                    $valid_extensions = array('jpg', 'jpeg', 'gif', 'png');
                    if ($_FILES['article_picture2']['size'] <= $max_size) {
                        $extension_file_uploaded = strtolower(substr(strrchr($_FILES['article_picture2']['name'], '.'), 1));
                        echo $extension_file_uploaded;
                        if (in_array($extension_file_uploaded, $valid_extensions)) {
                            $WB_image_directory_path = "Posts_images/Article/" . "WB_article : " . $current_post['article_title'] . "/1." . $extension_file_uploaded;
                            $resultat = move_uploaded_file($_FILES['article_picture2']['tmp_name'], $WB_image_directory_path);
                            if ($resultat) {
                                // Le chemin d'accès au fichier qui sera transmis à la base de donnée
                                $tmp_article_picture_2 = $WB_image_directory_path;
                            } else {
                                $errors['article_picture2'] = "Erreur durant le transfert de votre fichier";
                            }
                        } else {
                            $errors['article_picture2'] = "L'extension de votre image doit être jpg , jpeg, png, gif";
                        }
                    } else {
                        $errors['article_picture2'] = "La taille de votre image est supérieur à 2mo";
                    }
                }

                // traitement fichier 3
                if (isset($_FILES['article_picture3']) and !empty($_FILES['article_picture3']['name'])) {
                    $max_size = 2097152;
                    $valid_extensions = array('jpg', 'jpeg', 'gif', 'png');
                    if ($_FILES['article_picture3']['size'] <= $max_size) {
                        $extension_file_uploaded = strtolower(substr(strrchr($_FILES['article_picture3']['name'], '.'), 1));
                        echo $extension_file_uploaded;
                        if (in_array($extension_file_uploaded, $valid_extensions)) {
                            $WB_image_directory_path = "Posts_images/Article/" . "WB_article : " . $current_post['article_title'] . "/1." . $extension_file_uploaded;
                            $resultat = move_uploaded_file($_FILES['article_picture3']['tmp_name'], $WB_image_directory_path);
                            if ($resultat) {
                                // Le chemin d'accès au fichier qui sera transmis à la base de donnée
                                $tmp_article_picture_3 = $WB_image_directory_path;
                            } else {
                                $errors['article_picture3'] = "Erreur durant le transfert de votre fichier";
                            }
                        } else {
                            $errors['article_picture3'] = "L'extension de votre image doit être jpg , jpeg, png, gif";
                        }
                    } else {
                        $errors['article_picture3'] = "La taille de votre image est supérieur à 2mo";
                    }
                }
                break; // FIN ANNALYSE FORMULAIRE ARTICLE


            // CONTACT
            //-----------------------------------------------------------------------------------------------------------------------------\\
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
                break; // FIN ANNALYSE FORMULAIRE CONTACT
        }
//====================================================================================================================================//
// PARTIE TRAITEMENT DES DONNEES RECU APRES ANNALYSE
        //C'est ici après vérifications de l'intégrité des données envoyés 
        //-----------------------------------------------------------------------------------------------------------------------------
        //-----------------------------------------------------------------------------------------------------------------------------
        //-----------------------------------------------------------------------------------------------------------------------------

        // si il n'y a pas d'érreur
        if (empty($errors)) {


            switch ($treatment_type) {

                case "comment":

                    $current_data = new comment($current_post['comment_title'], $current_post['comment_author'], $current_post['comment_body'], $current_post['comment_category']);
                    break;
                case "article":

                    $current_data = new article($current_post['article_title'], $current_post['article_author'], $current_post['article_body'], $current_post['article_category'], $tmp_article_picture_1, $tmp_article_picture_2, $tmp_article_picture_3);


                    break;
                case "contact":
                    $current_data = new contact($current_post['contact_title'], $current_post['contact_author'], $current_post['contact_body'], $current_post['contact_category']);
                    break;
            }

            // Then we use "add" method of gestionnaire_data to add a new comment to the bdd / puis nous utilisons la méthode "add" pour ajouter un nouvel objet à notre bdd
            // La fonction interne add prend en paramètre un objet a ajouter a la base de donnée . un article un commentaire etc

            if (is_a($current_data, "article") and isset($_GET['article_id'])) {
                $this->modify($current_data, $_GET['article_id']);
            } else {
                $this->add($current_data);
            }

            $errors = "no_errors";
            $this->show_processing_message($errors);
            // if debug mod enabled then show / si le mode débug est activé alors afficher :
                
        // Si il y a des érreurs ont les affiches
        } else {
            if ($this->debugmode) {
                echo '<pre>' . var_dump($errors) . '</pre>';
            }
            $this->show_processing_message($errors);
        }

    }


//====================================================================================================================================//
// FONCTION INTERACTIONS UTILISATEURS .
        //Des fonctions qui servent à communiquer avec l'utilisateur . 
        //-----------------------------------------------------------------------------------------------------------------------------
        //-----------------------------------------------------------------------------------------------------------------------------
        //-----------------------------------------------------------------------------------------------------------------------------

    public function show_processing_message($dumb)
    {

        if ($this->debugmode) {
            echo "This is what's treatment of form sended / Voici le renvoi de la procédure traitement du formulaire : " . var_dump($dumb);
        }

        if ($dumb == "no_errors") {
        ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> Felicitation votre Post a bien été enregistré</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        } elseif (!empty($dumb)) {

            foreach ($dumb as $value) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>' . <?= $value; ?> . '</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
<?php
            }
        }
    }
}
