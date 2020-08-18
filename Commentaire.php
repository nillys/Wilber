<!DOCTYPE html>

<html lang="fr">

<?php

require "class_and_function.php";
require "db.php";

// instanciation du gestionnaire avec en paramètre le PDO et la variable super global $_POST en ajoutant un 1 en paramètre le mode debug est activé.
$gestionnaire_data = new dataManager($pdo, $_POST);

?>

<head>

  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="data.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">

  <link rel="stylesheet" type="text/css" href="Ressource_icone/open-iconic-master/open-iconic-master/font/css/open-iconic-bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script>
    function erase() {
      document.getElementById('author').value = '';
      document.getElementById('title').value = '';
      document.getElementById('body').value = '';
    }
  </script>

</head>



<body>
  <?php
  $gestionnaire_data->show_processing_message();

  $gestionnaire_data->add_treatment_mode(comment::generate_form());
  ?>
  

  <div id="afficher_data">
    <?php
    $gestionnaire_data->show_all_comment();

    ?>
  </div>


  <script src="bootstrap/js/jquery-3.4.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>