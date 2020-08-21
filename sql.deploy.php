<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="Ressource_icone/open-iconic-master/open-iconic-master/font/css/open-iconic-bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <style>
        #main_container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<div id="main_container">
    <?php

    if (!file_exists("config.php")) {
        header('location: start.php');
    }

    require "config.php";

    global $check_count;

    // CREATION de la table comment 
    try {
        $req = $pdo->query('CREATE TABLE IF NOT EXISTS `comment` (
        `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `author` varchar(100) NOT NULL,
        `body` varchar(255) NOT NULL,
        `category` varchar(255) DEFAULT NULL,
        `date_post` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`)
       ) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=utf8');

        //MESSAGE SUCCES
        $check_count += 1;

    ?>
        <div class="alert alert-success m-3 text-center" role="alert">
            <h4 class="alert-heading">Effectué !</h4>
            <p><strong>Succès ! </strong>La table commentaire a été créé avec succès ! </p>


        </div>
    <?php

    } catch (PDOException $e) {
    ?>

        <!-- MESSAGE ERREUR  -->

        <div class="alert alert-danger alert-dismissible fade show m-0 text-center" role="alert">

            <div class="card border-danger mb-3">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                        <strong>La création de la table "comment" a échoué </strong><em title="En vérifiant les informations">Si vous n'avez pas lancé start.php cela pourrait être la raison</em>
                        <button class="btn btn-danger btn-smbtn-danger " data-toggle="collapse" data-target="#returned_error" aria-expanded="false" aria-controls="returned_error">
                            Voir l'érreur retournée !
                        </button>
                        </h2>
                </div>

                <div id="returned_error" class="collapse" aria-labelledby="headingOne">
                    <div class="card-body"><?= $e->getMessage(); ?></div>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php
    }

    // CREATION de la table article 
    try {
        $req = $pdo->query('CREATE TABLE IF NOT EXISTS `article` (
        `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `author` varchar(100) NOT NULL,
        `body` varchar(255) NOT NULL,
        `category` varchar(255) DEFAULT NULL,
        `date_post` timestamp NOT NULL DEFAULT current_timestamp(),
        `photo1` varchar(100) DEFAULT NULL,
        `photo2` varchar(100) DEFAULT NULL,
        `photo3` varchar(100) DEFAULT NULL,
        PRIMARY KEY (`id`)
       ) ENGINE=MyISAM DEFAULT CHARSET=utf8');
        $check_count += 1;

        //MESSAGE SUCCES
    ?>
        <div class="alert alert-success m-3 text-center" role="alert">
            <h4 class="alert-heading">Effectué !</h4>
            <p><strong>Succès ! </strong>La table <strong>article</strong> a été créé avec succès ! </p>


        </div>
    <?php

    } catch (PDOException $e) {
    ?>

        <!-- MESSAGE ERREUR  -->

        <div class="alert alert-danger alert-dismissible fade show m-0 text-center" role="alert">

            <div class="card border-danger mb-3">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                        <strong>La création de la table "article" a échoué </strong><em title="En vérifiant les informations">Si vous n'avez pas lancé start.php cela pourrait être la raison</em>
                        <button class="btn btn-danger btn-smbtn-danger " data-toggle="collapse" data-target="#returned_error" aria-expanded="false" aria-controls="returned_error">
                            Voir l'érreur retournée !
                        </button>
                        </h2>
                </div>

                <div id="returned_error" class="collapse" aria-labelledby="headingOne">
                    <div class="card-body"><?= $e->getMessage(); ?></div>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php
    }

    // CREATION de la table contact 
    try {
        $req = $pdo->query('CREATE TABLE IF NOT EXISTS `contact` (
        `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `author` varchar(100) NOT NULL,
        `body` varchar(255) NOT NULL,
        `category` varchar(255) DEFAULT NULL,
        `date_post` timestamp NOT NULL DEFAULT current_timestamp(),
    
        PRIMARY KEY (`id`)
       ) ENGINE=MyISAM DEFAULT CHARSET=utf8');
        $check_count += 1;
        //MESSAGE SUCCES
    ?>
        <div class="alert alert-success m-3 text-center" role="alert">
            <h4 class="alert-heading">Effectué !</h4>
            <p><strong>Succès ! </strong>La table <strong>contact</strong> a été créé avec succès ! </p>


        </div>
    <?php

    } catch (PDOException $e) {
    ?>

        <!-- MESSAGE ERREUR  -->

        <div class="alert alert-danger alert-dismissible fade show m-0 text-center" role="alert">

            <div class="card border-danger mb-3">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                        <strong>La création de la table "article" a échoué </strong><em title="En vérifiant les informations">Si vous n'avez pas lancé start.php cela pourrait être la raison</em>
                        <button class="btn btn-danger btn-smbtn-danger " data-toggle="collapse" data-target="#returned_error" aria-expanded="false" aria-controls="returned_error">
                            Voir l'érreur retournée !
                        </button>
                        </h2>
                </div>

                <div id="returned_error" class="collapse" aria-labelledby="headingOne">
                    <div class="card-body"><?= $e->getMessage(); ?></div>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php
    }

    ?>

</div>

<div id="final_message">
    <?php
    if ($check_count == 3) {
    ?>
        <div class="alert alert-success m-4 text-center" role="alert">
            <h4 class="alert-heading">Fellicitation !</h4>
            <p><strong>Succès ! </strong>Les trois tables on été créé avec succès tout devrait bien fonctionner !</p>
            <a href="Exemple.php"><button class="card">Vous pouvez fermer cet onglet !</button></a>

        </div>

    <?php
    } else {
    ?>
        <div class="alert alert-danger m-4" role="alert">

            <strong>Malheuresement</strong> <em>une érreur est survenue lors de la création des tables pour la base de donné si vous le souhaitez vous pouvez consulter les erreurs retourné il est déconsseillé de poursuivre l'utilisation du module pour le moment </em>
            <quote>Si vous n'avez pas lancé start.php cela pourrait être la raison</quote>




        </div>
    <?php
    }
    ?>
</div>

<script src="bootstrap/js/jquery-3.4.1.min.js"></script>

<script src="bootstrap/js/bootstrap.bundle.js"></script>