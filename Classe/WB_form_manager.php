<?php

/**
 * form_manager
 * 
 * Classe servant a tester des paramètres entrés
 */
class form_manager
{

   private $errors_in_form = array();
   private $dumbed_image = array("","","");
   


   /**
    * checking_integrity
    *
    * @param  mixed $input l'envoie de la fonction
    * @param  mixed $Le nom utilisé pour qualifier le champ
    * @param  array $Un tableau de paramètre 0 pour désactiver cette verification
    * @param  array $Un tableau de paramètre 0 pour désactiver cette verification
    * @return void
    */

    public function __construct(){
        if (isset($_GET['article_id'])){
            $this->dumbed_image[0] = $_POST['article_picture1_name'];
        }
    }
        
   public function checking_integrity($name_of_POST, $name_of_field, $check_characters = array(1, '/^[a-z0-9A-Z_é]+$/'), $check_length = array(1, 1, 255))
   {
      $errors = [];

      if (isset($_POST[$name_of_POST])) {
         if ($check_characters[0]) {
            if (!preg_match($check_characters[1], $_POST[$name_of_POST])) {
               $errors['forbiden_caracters'] = "<strong>le champ <em>\"$name_of_field\"</em> Contient des caractères non autorisé !</strong> veuillez rentrer des caractères compris parmis ceux ci : " . $check_characters[1];
            }
         }
         if ($check_length[0]) {
            if (strlen($_POST[$name_of_POST]) < $check_length[1] or strlen($_POST[$name_of_POST]) > $check_length[2]) {
               $errors['out_of_range'] = "<strong>La longeur de <em>\"$name_of_field\"</em> est incorect !</strong> Veuillez rentrer une saisie supérieur a : $check_length[1] et inférieur à : $check_length[2]";
            }
         }
      } else {
         $errors['undefined_field'] = "Veuillez rentrer quelque chose dans le champ <em>\"$name_of_field\"</em>";
      }



      // si il y a des erreurs on envoi le tableau d'érreur au tableau principal a l'index portant le nom du champ !
      //ex : tableau_principal[nom] = ['forbiden_caracters' => message associé]
      if (!empty($errors)) {
         $this->errors_in_form[$name_of_field] = $errors;
      }
   }


   public function checking_picture_integrity($name_of_POST,$max_size = 2097152,$valid_extensions = array('jpg', 'jpeg', 'gif', 'png')){

    if (isset($_FILES[$name_of_POST]) and !empty($_FILES[$name_of_POST]['name'])) {

        if ($_FILES[$name_of_POST]['size'] <= $max_size) {
            $extension_file_uploaded = strtolower(substr(strrchr($_FILES[$name_of_POST]['name'], '.'), 1));
            if (in_array($extension_file_uploaded, $valid_extensions)) {
                $WB_image_directory_path = "Posts_images/Article/" . "WB_article_" . toolbox::clean($_POST['article_title']) . "/1." . $extension_file_uploaded;
                // Créer le dossier si celui ci n'éxiste pas . 
                if (!is_dir("Posts_images/Article/" . "WB_article_" . toolbox::clean($_POST['article_title']) . "/")) {
                    mkdir("Posts_images/Article/" . "WB_article_" . toolbox::clean($_POST['article_title']) . "/");
                }

                $resultat = move_uploaded_file($_FILES[$name_of_POST]['tmp_name'], $WB_image_directory_path);
                if ($resultat) {
                    // Le chemin d'accès au fichier qui sera transmis à la base de donnée
                    $this->dumbed_image[0] = $WB_image_directory_path;
                } else {
                    $this->errors_in_form[$name_of_POST] = "Erreur durant le transfert de votre fichier";
                }
            } else {
                $this->errors_in_form[$name_of_POST] = "L'extension de votre image doit être jpg , jpeg, png, gif";
            }
        } else {
            $this->errors_in_form[$name_of_POST] = "La taille de votre image est supérieur à 2mo";
        }
    }
   }

   public function processing_form($treatment_type)
   {
      if (empty($this->errors_in_form)) {


         switch ($treatment_type) {

            case "comment":

               $current_data = new comment($_POST['comment_title'], $_POST['comment_author'], $_POST['comment_body'], $_POST['comment_category']);
               break;
            case "article":

               $current_data = new article($_POST['article_title'], $_POST['article_author'], $_POST['article_body'], $_POST['article_category'], $this->dumbed_image[0], $this->dumbed_image[1], $this->dumbed_image[2]);


               break;
            case "contact":
               $current_data = new contact($_POST['contact_title'], $_POST['contact_author'], $_POST['contact_body'], $_POST['contact_category']);
               break;
         }

         // Then we use "add" method of gestionnaire_data to add a new comment to the bdd / puis nous utilisons la méthode "add" pour ajouter un nouvel objet à notre bdd
         // La fonction interne add prend en paramètre un objet a ajouter a la base de donnée . un article un commentaire etc

         if (is_a($current_data, "article") and isset($_GET['article_id'])) {
            dataManager::modify($current_data, $_GET['article_id']);
         } else {
            dataManager::add($current_data);
         }

?>

         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> Felicitation votre Post a bien été enregistré</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <?php

      } else {
         if (dataManager::$debugmode) {
            echo '<pre>' . var_dump($this->errors_in_form) . '</pre>';
         }

         foreach ($this->errors_in_form as $value) {
            foreach ($value as $value) {
         ?>

               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong><?= $value; ?></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
<?php
            }
         }
      }
   }




   public function result()
   {
      return $this->errors_in_form;
   }
}
