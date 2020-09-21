<?php

/**
 * form_manager
 * 
 * Classe servant a tester des paramètres entrés
 */
class formManager
{
   // Contient un tableau de tableau
   private $errors_in_form = array();
   private $dumbed_image = array("", "", "");




   public function __construct()
   {
      if (isset($_GET['article_id'])) {
         $this->dumbed_image[0] = $_POST['article_picture1_name'];
      }
   }

   /**
    * Vérifie l'intégrité d'un input 
    *
    * A chaque execution la fonction va effectuer une série de test sur un champ choisit . En cas d'érreur un tableau avec le nom du champ est retourné au tableau principal contenant sous forme d'index le nom des erreurs trouvé ainsi que le message d'érreur associé
    *
    * @param  mixed $name_of_POST
    * @param  mixed $name_of_field
    * @param  mixed $check_characters
    * @param  mixed $check_length
    * @param  mixed $check_mail
    * @param  mixed $check_compare
    * @return void
    */
   public function checking_integrity($name_of_POST, $name_of_field, $check_characters = array('/^[a-z0-9A-Z_é]+$/'), $check_length = array(1, 1, 255), $check_mail = 1, $check_compare = "",$check_if_exist_bdd = 0)
   {
      $errors = [];
      if ($check_characters == 1) {
         $check_characters = array(1, '/^[a-z0-9A-Z_é]+$/');
      }elseif($check_characters == 0){
         $check_characters = "";
      }
      if ($check_length == 1) {
         $check_length = array(1, 1, 255);
      }

      if ($check_mail == 1) {
      }
      

      if (isset($_POST[$name_of_POST])) {
         if ($check_characters != "") {
            if (!preg_match($check_characters[1], $_POST[$name_of_POST])) {
               $errors['forbiden_caracters'] = "<strong>le champ <em>\"$name_of_field\"</em> Contient des caractères non autorisé !</strong> veuillez rentrer des caractères compris parmis ceux ci : " . str_replace(["/", "^", "+", "$", "[", "]"], "", $check_characters[1]);
            }
         }
         if ($check_length[0] != 0) {
            if (strlen($_POST[$name_of_POST]) < $check_length[1] or strlen($_POST[$name_of_POST]) > $check_length[2]) {
               $errors['out_of_range'] = "<strong>La longeur de <em>\"$name_of_field\"</em> est incorect !</strong> Veuillez rentrer une saisie supérieur a : $check_length[1] et inférieur à : $check_length[2]";
            }
         }

         if ($check_mail != 0) {
            if (!filter_var($_POST[$name_of_POST], FILTER_VALIDATE_EMAIL)) {
               $errors['incorect_email'] = "<strong>Votre email n'est pas valide</strong>";
            }
         }

         if ($check_compare != "") {
            if ($_POST[$name_of_POST] != $_POST[$check_compare]) {
               $errors['field_do_not_match'] = "<strong>Les deux $name_of_field ne corespondent pas</strong>";
            }
         } 
         if ($check_if_exist_bdd != 0) {
            
            $result = DB::pull_data_from_db($check_if_exist_bdd[0],$check_if_exist_bdd[1],$_POST[$name_of_POST]);

            if ($result) {
               $errors['Already in BDD'] = "Désolé $name_of_field est déjà utilisé , veuillez réessayer avec une valeur différente";
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




   public function checking_picture_integrity($name_of_POST, $max_size = 2097152, $valid_extensions = array('jpg', 'jpeg', 'gif', 'png'))
   {

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

   private function show_errors_messages()
   {
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

   private function show_success_message($message)
   {
      ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong><?= $message ?></strong>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
<?php
   }

   public function processing_data_form($treatment_type)
   {
      if (empty($this->errors_in_form) and $treatment_type != "") {


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

            case "user":
               $current_data = new user($_POST['user_pseudo'], $_POST['user_mail'], $_POST['user_password'], "");
         }

         // Then we use "add" method of gestionnaire_data to add a new comment to the bdd / puis nous utilisons la méthode "add" pour ajouter un nouvel objet à notre bdd
         // La fonction interne add prend en paramètre un objet a ajouter a la base de donnée . un article un commentaire etc

         if (is_a($current_data, "article") and isset($_GET['article_id'])) {
            dataManager::modify_data($current_data, $_GET['article_id']);
         } else {
            dataManager::add_data($current_data);
         }
         $this->show_success_message("Felicitation votre post a été bien envoyé");
      } else {
         $this->show_errors_messages();
      }
   }

   public function processing_user_form()
   {
      if (empty($this->errors_in_form)) {

            $password_crypted = password_hash($_POST['user_password'],PASSWORD_BCRYPT);

               $current_user = new user($_POST['user_pseudo'], $_POST['user_mail'], $password_crypted, "user");
         

         // Then we use "add" method of gestionnaire_data to add a new comment to the bdd / puis nous utilisons la méthode "add" pour ajouter un nouvel objet à notre bdd
         // La fonction interne add prend en paramètre un objet a ajouter a la base de donnée . un article un commentaire etc

        
            userManager::add_user($current_user);

         $this->show_success_message("Felicitation votre inscription a bien été enregistré");

      } else {

         $this->show_errors_messages();
      }
   }
}
