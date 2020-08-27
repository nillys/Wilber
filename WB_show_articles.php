<!DOCTYPE html>

<html lang="fr">

<?php

require "Wilber.php";
$gestionnaire_data = new dataManager($pdo, $_POST);

?>

<head>

    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="WB_main_theme.css">

<link rel="stylesheet" type="text/css" href="Ressource_code/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="WB_main_css.css">
    <link rel="stylesheet" type="text/css" href="Ressource_icone/open-iconic-master/open-iconic-master/font/css/open-iconic-bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="Wilber.script.js"></script>

</head>

<header id="header">
    <a href="WB_accueil.php"><h1 id="main_title">WILBER</h1></a>
    <h6 id="label_version"><?=$WB_version_number;?></h6>
    <h6 id="label_version"><?=$WB_slogan;?></h6>
    <h2 id="page_name">Afficher un article</h2>

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
            <div class="col-lg-12">
                <?php

                $gestionnaire_data->show_all_article_thumbnail();

                ?>
            </div>
            <!-- partie affichage 1 ligne seulement-->

        </div>
    </div><!-- ARTICLE -->


    <script src="bootstrap/js/jquery-3.4.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>