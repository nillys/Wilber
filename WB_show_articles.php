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
    <a href="exemple.php"><h1 id="main_title">WILBER</h1></a>
    <h2 id="page_name">Afficher un article</h2>
    <h6 id="label_version">Version Alpha(0.0.07)</h6>
    <p>Content managing made : <em>easy fresh and simple !</em> (for developper)</p>

</header>

<body>
    <!-- ARTICLE  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php

                $gestionnaire_data->show_an_article();

                ?>
            </div>
            <!-- partie affichage 1 ligne seulement-->

        </div>
    </div><!-- ARTICLE -->


    <script src="bootstrap/js/jquery-3.4.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>