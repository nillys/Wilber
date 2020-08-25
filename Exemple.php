<!DOCTYPE html>

<html lang="fr">

<?php

require "Wilber.php";
$gestionnaire_data = new dataManager($pdo, $_POST);

?>

<head>

  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="Wilber.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">

  <link rel="stylesheet" type="text/css" href="Ressource_icone/open-iconic-master/open-iconic-master/font/css/open-iconic-bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="Wilber.script.js"></script>

</head>

<header id="header">
  <h1 id="main_title">WILBER</h1>
  <h6 id="label_version">Version Alpha(0.05)</h6>
  <p>Content managing made : <em>easy fresh and simple !</em> (for developper)</p>

</header>

<body>
  <!-- ARTICLE  -->
  <div class="container-fluid">
    <div class="row">
      <!-- partie formulaire et traitement 2 lignes-->
      <div class="col-lg-12">
        <?php
        // montrer les messages d'intéraction utilisateur

        // générer le formulaire de votre choix avec enclenchement de la procédure de traitement.
        // la partie generate form génère le formulaire et renvoi à la partie traitement les indications traiter de façon approprié le type de contenu
        // la partie treatement détecte si il y a un post , traite le formulaire , se charge d'afficher les érreurs et d'envoyer les données à la base de donnée
        $gestionnaire_data->add_treatment(article::generate_form());

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
        $gestionnaire_data->add_treatment(comment::generate_form());

        ?>
      </div>
      <!-- partie affichage 1 ligne seulement-->
      <div class="col-lg-6" style="max-height:100%">

        <?php
        $gestionnaire_data->show_all_comment();
        ?>

      </div>
    </div>
  </div>

  <script src="bootstrap/js/jquery-3.4.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>