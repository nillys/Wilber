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
    <script src="JS/Wilber.script.js"></script>

</head>

<body>

    <?php require "inc/WB_header.php"?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-3"> <?php user::generate_user_register_form() ?></div>

        </div>
    </div>

</body>



<script src="ressource_code/bootstrap/js/jquery-3.4.1.min.js">

</script>
<script src="ressource_code/bootstrap/js/bootstrap.bundle.js"></script>

</html>