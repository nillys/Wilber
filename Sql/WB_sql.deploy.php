<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Ressource_code/bootstrap/css/bootstrap.css">

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

    if (!file_exists("info.db.php")) {
        header('location: WB_start.php');
    }

    require "info.db.php";

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

        // $req = $pdo->query("INSERT INTO `comment` (`id`, `title`, `author`, `body`, `category`, `date_post`) VALUES (NULL, 'Wilber', 'Nillys', 'Le logiciel avance bien je suis fier d\'annoncer qu\'il a atteint la version 0.1.0 (alpha) . La route sera longue jusqu\'à ce qu\'il soit doté de toutes les fonctionnalités que j\'espère qu\'il aura mais ... La route est amusante .', 'Les développeur', '2020-08-27 23:37:54'");
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
                        <strong>La création de la table "comment" a échoué </strong><em title="En vérifiant les informations">Si vous n'avez pas lancé WB_start.php cela pourrait être la raison</em>
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
        `body` text NOT NULL,
        `category` varchar(255) DEFAULT NULL,
        `slug` varchar(255) DEFAULT NULL,
        `visible` boolean DEFAULT NULL,
        `date_post` timestamp NOT NULL DEFAULT current_timestamp(),
        `article_picture1` varchar(100) DEFAULT NULL,
        `article_picture2` varchar(100) DEFAULT NULL,
        `article_picture3` varchar(100) DEFAULT NULL,
        PRIMARY KEY (`id`)
       ) ENGINE=MyISAM DEFAULT CHARSET=utf8');



        // $req = $pdo->query("INSERT INTO `article` (`id`, `title`, `author`, `body`, `category`, `article_picture1`, `article_picture2`, `article_picture3`, `date_post`) VALUES (NULL, 'wilber : Un nouvel outil de gestion de contenu en open source', 'Nillys', '<h1 style=\"text-align: center;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Un outil formidable</span></h1>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: arial, helvetica, sans-serif;\"><strong><em>\"Wilber permet de faire de fa&ccedil;on simple , des choses compliqu&eacute;es\"</em></strong></span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: arial, helvetica, sans-serif;\"><strong><em>\"Le but &eacute;tait de concevoir un outil amusant et sympa &agrave; utiliser\"</em></strong></span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><em><span style=\"font-family: verdana, geneva, sans-serif;\">Wilber est un gestionnaire de contenu de type blog orient&eacute; d&eacute;veloppeur on peut facilement le t&eacute;l&eacute;charger et l\'utiliser dans n\'importes quels projets ! </span></em></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: verdana, geneva, sans-serif;\">(Une fois install&eacute; sur un serveur (exemple W.A.M.P en local) il d&eacute;ploie lui m&ecirc;me la modeste architecture de donn&eacute;e dont il a besoin pour stocker son contenu (Articles , Commentaires,Contact)</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: verdana, geneva, sans-serif;\"></span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: verdana, geneva, sans-serif;\"><em><strong>\"j\'en avais marre de recr&eacute;er toujours les m&ecirc;mes fonctions et application &agrave; chaque fois que j\'avais besoin de mettre en place une solution de gestion de contenu (et en plus de fa&ccedil;on non optimis&eacute;) je me suis dis que &ccedil;a vallait la peine de le faire proprement une bonne fois pour toute\"</strong></em></span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: verdana, geneva, sans-serif; font-size: 18pt;\"><em><strong>La devise de wilber :</strong></em></span></p>\r\n<p style=\"text-align: center;\"><span style=\"text-decoration: underline;\"><span style=\"font-family: verdana, geneva, sans-serif; font-size: 18pt;\">La gestion de contenu rendu facile et agr&eacute;able!</span></span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: verdana, geneva, sans-serif;\"><em><span style=\"text-decoration: underline;\">La simplicit&eacute; avant tout pour l\'utilisateur</span> / La lisibilit&eacute; et la propret&eacute; du code <strong>pour les d&eacute;veloppeurs souhaitant contribuer &agrave; ce projet Open-Source </strong></em></span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: verdana, geneva, sans-serif;\"><em>\"Mon but tout au long du d&eacute;velloppement de wilber a &eacute;t&eacute; de le rendre le plus agr&eacute;able possible pour ses utilisateurs mais aussi de rendre son code lisible , propre et logique\"</em></span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>', 'Le module', 'Posts_images/Article/WB_article_wilber-Un-nouvel-outil-de-gestion-de-contenu-en-open-source/1.jpg', '', '', '2020-08-27 23:07:13'");

        // $req = $pdo->query("INSERT INTO `article` (`id`, `title`, `author`, `body`, `category`, `article_picture1`, `article_picture2`, `article_picture3`, `date_post`) VALUES (NULL, 'Qu\'est ce qu\'un module ?', 'Nillys', '<h5 style=\"text-align: center;\"><strong>En informatique, la programmation modulaire reprend l\'id&eacute;e de fabriquer un produit (le programme) &agrave; partir de composants (les modules). </strong></h5>\r\n<p style=\"text-align: center;\">Elle d&eacute;compose une grosse <a title=\"Application (informatique)\" href=\"https://fr.wikipedia.org/wiki/Application_(informatique)\">application</a> en <a title=\"Module (programmation)\" href=\"https://fr.wikipedia.org/wiki/Module_(programmation)\">modules</a>, groupes de fonctions, de m&eacute;thodes et de traitement, pour pouvoir les d&eacute;velopper et les am&eacute;liorer ind&eacute;pendamment, puis les <a title=\"R&eacute;utilisabilit&eacute;\" href=\"https://fr.wikipedia.org/wiki/R%C3%A9utilisabilit%C3%A9\">r&eacute;utiliser</a> dans d\'autres applications.</p>\r\n<p style=\"text-align: center;\">Le d&eacute;veloppement du <a title=\"Code source\" href=\"https://fr.wikipedia.org/wiki/Code_source\">code</a> des modules peut &ecirc;tre attribu&eacute; &agrave; des (groupes de) personnes diff&eacute;rentes, qui effectuent leurs <a title=\"Tests unitaires\" href=\"https://fr.wikipedia.org/wiki/Tests_unitaires\">tests unitaires</a> ind&eacute;pendamment.</p>\r\n<p style=\"text-align: center;\">Cette m&eacute;thode de regroupement permet de r&eacute;aliser une <a title=\"Encapsulation (programmation)\" href=\"https://fr.wikipedia.org/wiki/Encapsulation_(programmation)\">encapsulation</a> comparable par certains aspects &agrave; celle de la <a title=\"Programmation objet\" href=\"https://fr.wikipedia.org/wiki/Programmation_objet\">programmation objet</a>, et permet l\'organisation du code source en unit&eacute;s de travail logiques. Les modules d&eacute;finissent &eacute;galement des <a title=\"Espace de noms (programmation)\" href=\"https://fr.wikipedia.org/wiki/Espace_de_noms_(programmation)\">espaces de noms</a> utiles lors de leur utilisation.</p>\r\n<p style=\"text-align: center;\">La programmation modulaire n\'implique pas l\'usage d\'un style de ou d\'un <a title=\"Paradigme\" href=\"https://fr.wikipedia.org/wiki/Paradigme\">paradigme</a> de <a title=\"Programmation\" href=\"https://fr.wikipedia.org/wiki/Programmation\">programmation</a> particulier&nbsp;; les &eacute;l&eacute;ments qu\'elle structure peuvent &ecirc;tre de style <a title=\"Programmation orient&eacute;e objet\" href=\"https://fr.wikipedia.org/wiki/Programmation_orient%C3%A9e_objet\">objet</a>, <a title=\"Programmation imp&eacute;rative\" href=\"https://fr.wikipedia.org/wiki/Programmation_imp%C3%A9rative\">imp&eacute;ratif</a> ou <a title=\"Programmation fonctionnelle\" href=\"https://fr.wikipedia.org/wiki/Programmation_fonctionnelle\">fonctionnel</a>.</p>\r\n<p style=\"text-align: center;\">L\'oppos&eacute;e de la programmation modulaire est le <a title=\"Raffinement\" href=\"https://fr.wikipedia.org/wiki/Raffinement\">raffinement</a>.</p>\r\n<p style=\"text-align: center;\">Ce style de programmation facilite grandement l\'am&eacute;lioration progressive, la r&eacute;-utilisabilit&eacute; et le partage du code, et est particuli&egrave;rement utile pour la r&eacute;alisation de <a title=\"Biblioth&egrave;que (informatique)\" href=\"https://fr.wikipedia.org/wiki/Biblioth%C3%A8que_(informatique)\">biblioth&egrave;ques</a>.</p>\r\n<p style=\"text-align: center;\">De plus, suivant les <a title=\"Langage de programmation\" href=\"https://fr.wikipedia.org/wiki/Langage_de_programmation\">langages de programmation</a>, les modules peuvent &ecirc;tre param&eacute;tr&eacute;s et/ou <a title=\"Polymorphisme (informatique)\" href=\"https://fr.wikipedia.org/wiki/Polymorphisme_(informatique)\">polymorphes</a> (<a title=\"Foncteur\" href=\"https://fr.wikipedia.org/wiki/Foncteur\">foncteur</a>) ce qui apporte une modularit&eacute; dont la souplesse d&eacute;cupl&eacute;e am&egrave;ne alors &agrave; parler de <a title=\"\" href=\"https://fr.wikipedia.org/wiki/G%C3%A9n%C3%A9ricit%C3%A9\">g&eacute;n&eacute;ricit&eacute;</a>.</p>\r\n<p style=\"text-align: center;\">La <a title=\"Programmation g&eacute;n&eacute;rique\" href=\"https://fr.wikipedia.org/wiki/Programmation_g%C3%A9n%C3%A9rique\">programmation g&eacute;n&eacute;rique</a> est un sur-ensemble qui peut tirer avantageusement parti de la modularit&eacute; apport&eacute;e par la programmation modulaire.</p>', 'Le module', 'Posts_images/Article/WB_article_Quest-ce-quun-module-/1.jpg', '', '', '2020-08-27 23:31:12'");
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
                        <strong>La création de la table "article" a échoué </strong><em title="En vérifiant les informations">Si vous n'avez pas lancé WB_start.php cela pourrait être la raison</em>
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
                        <strong>La création de la table "article" a échoué </strong><em title="En vérifiant les informations">Si vous n'avez pas lancé WB_start.php cela pourrait être la raison</em>
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
    // CREATION de la table utilisateur 
    try {
        $req = $pdo->query('CREATE TABLE IF NOT EXISTS `user` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `pseudo` varchar(255) NOT NULL,
    `mail` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role` varchar(255) DEFAULT NULL,
    `date_post` timestamp NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
   ) ENGINE=MyISAM DEFAULT CHARSET=utf8');



        // $req = $pdo->query("INSERT INTO `article` (`id`, `title`, `author`, `body`, `category`, `article_picture1`, `article_picture2`, `article_picture3`, `date_post`) VALUES (NULL, 'wilber : Un nouvel outil de gestion de contenu en open source', 'Nillys', '<h1 style=\"text-align: center;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Un outil formidable</span></h1>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: arial, helvetica, sans-serif;\"><strong><em>\"Wilber permet de faire de fa&ccedil;on simple , des choses compliqu&eacute;es\"</em></strong></span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: arial, helvetica, sans-serif;\"><strong><em>\"Le but &eacute;tait de concevoir un outil amusant et sympa &agrave; utiliser\"</em></strong></span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><em><span style=\"font-family: verdana, geneva, sans-serif;\">Wilber est un gestionnaire de contenu de type blog orient&eacute; d&eacute;veloppeur on peut facilement le t&eacute;l&eacute;charger et l\'utiliser dans n\'importes quels projets ! </span></em></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: verdana, geneva, sans-serif;\">(Une fois install&eacute; sur un serveur (exemple W.A.M.P en local) il d&eacute;ploie lui m&ecirc;me la modeste architecture de donn&eacute;e dont il a besoin pour stocker son contenu (Articles , Commentaires,Contact)</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: verdana, geneva, sans-serif;\"></span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: verdana, geneva, sans-serif;\"><em><strong>\"j\'en avais marre de recr&eacute;er toujours les m&ecirc;mes fonctions et application &agrave; chaque fois que j\'avais besoin de mettre en place une solution de gestion de contenu (et en plus de fa&ccedil;on non optimis&eacute;) je me suis dis que &ccedil;a vallait la peine de le faire proprement une bonne fois pour toute\"</strong></em></span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: verdana, geneva, sans-serif; font-size: 18pt;\"><em><strong>La devise de wilber :</strong></em></span></p>\r\n<p style=\"text-align: center;\"><span style=\"text-decoration: underline;\"><span style=\"font-family: verdana, geneva, sans-serif; font-size: 18pt;\">La gestion de contenu rendu facile et agr&eacute;able!</span></span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: verdana, geneva, sans-serif;\"><em><span style=\"text-decoration: underline;\">La simplicit&eacute; avant tout pour l\'utilisateur</span> / La lisibilit&eacute; et la propret&eacute; du code <strong>pour les d&eacute;veloppeurs souhaitant contribuer &agrave; ce projet Open-Source </strong></em></span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: verdana, geneva, sans-serif;\"><em>\"Mon but tout au long du d&eacute;velloppement de wilber a &eacute;t&eacute; de le rendre le plus agr&eacute;able possible pour ses utilisateurs mais aussi de rendre son code lisible , propre et logique\"</em></span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>', 'Le module', 'Posts_images/Article/WB_article_wilber-Un-nouvel-outil-de-gestion-de-contenu-en-open-source/1.jpg', '', '', '2020-08-27 23:07:13'");

        // $req = $pdo->query("INSERT INTO `article` (`id`, `title`, `author`, `body`, `category`, `article_picture1`, `article_picture2`, `article_picture3`, `date_post`) VALUES (NULL, 'Qu\'est ce qu\'un module ?', 'Nillys', '<h5 style=\"text-align: center;\"><strong>En informatique, la programmation modulaire reprend l\'id&eacute;e de fabriquer un produit (le programme) &agrave; partir de composants (les modules). </strong></h5>\r\n<p style=\"text-align: center;\">Elle d&eacute;compose une grosse <a title=\"Application (informatique)\" href=\"https://fr.wikipedia.org/wiki/Application_(informatique)\">application</a> en <a title=\"Module (programmation)\" href=\"https://fr.wikipedia.org/wiki/Module_(programmation)\">modules</a>, groupes de fonctions, de m&eacute;thodes et de traitement, pour pouvoir les d&eacute;velopper et les am&eacute;liorer ind&eacute;pendamment, puis les <a title=\"R&eacute;utilisabilit&eacute;\" href=\"https://fr.wikipedia.org/wiki/R%C3%A9utilisabilit%C3%A9\">r&eacute;utiliser</a> dans d\'autres applications.</p>\r\n<p style=\"text-align: center;\">Le d&eacute;veloppement du <a title=\"Code source\" href=\"https://fr.wikipedia.org/wiki/Code_source\">code</a> des modules peut &ecirc;tre attribu&eacute; &agrave; des (groupes de) personnes diff&eacute;rentes, qui effectuent leurs <a title=\"Tests unitaires\" href=\"https://fr.wikipedia.org/wiki/Tests_unitaires\">tests unitaires</a> ind&eacute;pendamment.</p>\r\n<p style=\"text-align: center;\">Cette m&eacute;thode de regroupement permet de r&eacute;aliser une <a title=\"Encapsulation (programmation)\" href=\"https://fr.wikipedia.org/wiki/Encapsulation_(programmation)\">encapsulation</a> comparable par certains aspects &agrave; celle de la <a title=\"Programmation objet\" href=\"https://fr.wikipedia.org/wiki/Programmation_objet\">programmation objet</a>, et permet l\'organisation du code source en unit&eacute;s de travail logiques. Les modules d&eacute;finissent &eacute;galement des <a title=\"Espace de noms (programmation)\" href=\"https://fr.wikipedia.org/wiki/Espace_de_noms_(programmation)\">espaces de noms</a> utiles lors de leur utilisation.</p>\r\n<p style=\"text-align: center;\">La programmation modulaire n\'implique pas l\'usage d\'un style de ou d\'un <a title=\"Paradigme\" href=\"https://fr.wikipedia.org/wiki/Paradigme\">paradigme</a> de <a title=\"Programmation\" href=\"https://fr.wikipedia.org/wiki/Programmation\">programmation</a> particulier&nbsp;; les &eacute;l&eacute;ments qu\'elle structure peuvent &ecirc;tre de style <a title=\"Programmation orient&eacute;e objet\" href=\"https://fr.wikipedia.org/wiki/Programmation_orient%C3%A9e_objet\">objet</a>, <a title=\"Programmation imp&eacute;rative\" href=\"https://fr.wikipedia.org/wiki/Programmation_imp%C3%A9rative\">imp&eacute;ratif</a> ou <a title=\"Programmation fonctionnelle\" href=\"https://fr.wikipedia.org/wiki/Programmation_fonctionnelle\">fonctionnel</a>.</p>\r\n<p style=\"text-align: center;\">L\'oppos&eacute;e de la programmation modulaire est le <a title=\"Raffinement\" href=\"https://fr.wikipedia.org/wiki/Raffinement\">raffinement</a>.</p>\r\n<p style=\"text-align: center;\">Ce style de programmation facilite grandement l\'am&eacute;lioration progressive, la r&eacute;-utilisabilit&eacute; et le partage du code, et est particuli&egrave;rement utile pour la r&eacute;alisation de <a title=\"Biblioth&egrave;que (informatique)\" href=\"https://fr.wikipedia.org/wiki/Biblioth%C3%A8que_(informatique)\">biblioth&egrave;ques</a>.</p>\r\n<p style=\"text-align: center;\">De plus, suivant les <a title=\"Langage de programmation\" href=\"https://fr.wikipedia.org/wiki/Langage_de_programmation\">langages de programmation</a>, les modules peuvent &ecirc;tre param&eacute;tr&eacute;s et/ou <a title=\"Polymorphisme (informatique)\" href=\"https://fr.wikipedia.org/wiki/Polymorphisme_(informatique)\">polymorphes</a> (<a title=\"Foncteur\" href=\"https://fr.wikipedia.org/wiki/Foncteur\">foncteur</a>) ce qui apporte une modularit&eacute; dont la souplesse d&eacute;cupl&eacute;e am&egrave;ne alors &agrave; parler de <a title=\"\" href=\"https://fr.wikipedia.org/wiki/G%C3%A9n%C3%A9ricit%C3%A9\">g&eacute;n&eacute;ricit&eacute;</a>.</p>\r\n<p style=\"text-align: center;\">La <a title=\"Programmation g&eacute;n&eacute;rique\" href=\"https://fr.wikipedia.org/wiki/Programmation_g%C3%A9n%C3%A9rique\">programmation g&eacute;n&eacute;rique</a> est un sur-ensemble qui peut tirer avantageusement parti de la modularit&eacute; apport&eacute;e par la programmation modulaire.</p>', 'Le module', 'Posts_images/Article/WB_article_Quest-ce-quun-module-/1.jpg', '', '', '2020-08-27 23:31:12'");
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
                        <strong>La création de la table "article" a échoué </strong><em title="En vérifiant les informations">Si vous n'avez pas lancé WB_start.php cela pourrait être la raison</em>
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
            <a href="WB_accueil.php"><button class="card">Vous pouvez fermer cet onglet !</button></a>

        </div>

    <?php
    } else {
    ?>
        <div class="alert alert-danger m-4" role="alert">

            <strong>Malheuresement</strong> <em>une érreur est survenue lors de la création des tables pour la base de donné si vous le souhaitez vous pouvez consulter les erreurs retourné il est déconsseillé de poursuivre l'utilisation du module pour le moment </em>
            <quote>Si vous n'avez pas lancé WB_start.php cela pourrait être la raison</quote>




        </div>
    <?php
    }
    ?>
</div>

<script src="Ressource_icone/bootstrap/js/jquery-3.4.1.min.js"></script>

<script src="Ressource_icone/bootstrap/js/bootstrap.bundle.js"></script>