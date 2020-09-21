<!DOCTYPE html>

<html lang="fr">

<?php

require "Wilber.php";
$gestionnaire_data = new dataManager($_POST);

?>

<head>

  <meta charset="utf-8">

  <link rel="stylesheet" type="text/css" href="Ressource_code/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="CSS/WB_main_css.css">
  <link rel="stylesheet" type="text/css" href="CSS/WB_main_theme.css">
  <link rel="stylesheet" type="text/css" href="Ressource_icone/open-iconic-master/open-iconic-master/font/css/open-iconic-bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


</head>

<?php require "Inc/WB_header.php" ?>
<body>
  <!-- ARTICLE  -->
  <div class="container-fluid">
    <div class="row">
      <!-- partie formulaire et traitement 2 lignes-->
      <div class="col-lg-12">
        <?php

        article::generate_form();

        ?>

      </div>

    </div>
    <div class="row">
      <div class="col-lg-12">
        <?php

        article::show_all_article_thumbnail();

        ?>
      </div>
      <!-- partie affichage 1 ligne seulement-->

    </div>
  </div><!-- ARTICLE -->


  <div class="container-fluid">
    <div class="row">
      <!-- partie formulaire et traitement 2 lignes-->
      <div class="col-lg-6">
        <?php
        // montrer les messages d'intéraction utilisateur

        // générer le formulaire de votre choix avec enclenchement de la procédure de traitement.
        comment::generate_form();

        ?>
      </div>
      <!-- partie affichage 1 ligne seulement-->
      <div class="col-lg-6" style="max-height:100%">

        <?php
        comment::show_all_comment();
        ?>

      </div>
    </div>
  </div>

  <script src="Wilber.script.js"></script>
  <script src="ressource_code/bootstrap/js/jquery-3.4.1.min.js">

  </script>
  <script src="ressource_code/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>