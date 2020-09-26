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
   public function checking_integrity($name_of_POST, $name_of_field, $check_characters = '/^[a-z0-9A-Z_é]+$/', $check_length = array(1, 1, 255), $check_mail = 0, $check_compare = "", $check_password_compare = "", $check_if_exist_bdd = 0)
   {
      $errors = [];
      if ($check_characters == 1) {
         $check_characters = '/^[a-z0-9A-Z_é]+$/';
      } elseif ($check_characters == 0) {
         $check_characters = "";
      }
      if ($check_length == 1) {
         $check_length = array(1, 1, 255);
      }

      if ($check_mail == 1) {
      }
      if ($check_password_compare == 1) {
      }


      if (isset($_POST[$name_of_POST])) {
         if ($check_characters != "") {
            if (!preg_match($check_characters, $_POST[$name_of_POST])) {
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
         if ($check_password_compare != "") {

            $req = DB::$pdo->prepare('SELECT * FROM user WHERE (pseudo = :username OR mail = :username) AND confirmed_at IS NOT NULL');
            $req->execute(['username' => $_POST[$check_password_compare[0]]]);

            $result = $req->fetch();


            // die(var_dump($result));
            
            if ($result == false or !password_verify($_POST[$name_of_POST], $result->password)) {
               $errors['password_do_no_match'] = "<strong>Votre mot de passe ou identifiant est incorect</strong>";
            }
         }
         if ($check_if_exist_bdd != 0) {

            $result = DB::pull_data_from_db($check_if_exist_bdd[0], $check_if_exist_bdd[1], $_POST[$name_of_POST]);

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

   public function processing_data_form($treatment_type, $posted_data)
   {
      if (empty($this->errors_in_form) and $treatment_type != "") {


         switch ($treatment_type) {

            case "comment":

               $current_data = new comment($posted_data['comment_title'], $posted_data['comment_author'], $posted_data['comment_body'], $posted_data['comment_category']);
               break;
            case "article":

               if (!isset($posted_data['article_visibility'])) {
                  $posted_data['article_visibility'] = 0;
               }

               $current_data = new article($posted_data['article_title'], $posted_data['article_author'], $posted_data['article_body'], $posted_data['article_category'], "", $posted_data['article_visibility'], $this->dumbed_image[0], $this->dumbed_image[1], $this->dumbed_image[2]);


               break;
            case "contact":
               $current_data = new contact($posted_data['contact_title'], $posted_data['contact_author'], $posted_data['contact_body'], $posted_data['contact_category']);
               break;

            case "user":
               $current_data = new user($posted_data['user_pseudo'], $posted_data['user_mail'], $posted_data['user_password'], "");
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

   public function processing_user_register_form()
   {
      if (empty($this->errors_in_form)) {

         $password_crypted = password_hash($_POST['user_password'], PASSWORD_BCRYPT);

         $confirmation_token = toolbox::generate_token(60);

         $current_user = new user($_POST['user_pseudo'], $_POST['user_mail'], $password_crypted, "user", $confirmation_token);


         // Then we use "add" method of gestionnaire_data to add a new comment to the bdd / puis nous utilisons la méthode "add" pour ajouter un nouvel objet à notre bdd
         // La fonction interne add prend en paramètre un objet a ajouter a la base de donnée . un article un commentaire etc
         userManager::add_user($current_user);

         $current_user_id = DB::$pdo->lastInsertId();
         $this->show_success_message("Felicitation votre inscription a bien été enregistré veuillez cliquer sur ce lien pour valider votre inscrpition <a href=\"Sql/WB_sql_treatment?confirmation_token=$confirmation_token&user_id=$current_user_id\">Lien de confirmation</a>");
      } else {

         $this->show_errors_messages();
      }
   }
   public function processing_user_loggin_form()
   {
      if (!empty($_POST)) {
         if (empty($this->errors_in_form)) {

            $req = DB::$pdo->prepare('SELECT * FROM user WHERE (pseudo = :user_login OR mail = :user_login) AND confirmed_at IS NOT NULL');
            $req->execute(['user_login' => $_POST['user_login']]);


            $_SESSION['logged_in'] = $req->fetch();

            toolbox::write_flash_message(
            ["Bonjour " . $_SESSION['logged_in']->pseudo . " content de te revoir !",
            "Bonjour " . $_SESSION['logged_in']->pseudo . " Comment vas tu aujourd'hui",
            "Bonjour " . $_SESSION['logged_in']->pseudo . " Hey c'est cool de te revoir"][rand(0,2)],"success");
            header("Location: WBP_user_account.php");
         } else {
            $this->show_errors_messages();
         }
      }
   }
}
