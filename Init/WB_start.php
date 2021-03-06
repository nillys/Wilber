<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../CSS/WB_start.css">
    <link rel="stylesheet" type="text/css" href="../Ressource_code/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="../Ressource_icone/open-iconic-master/open-iconic-master/font/css/open-iconic-bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script>
        function autofill() {
            document.getElementById('bdd_adress').value = 'localhost';
            document.getElementById('bdd_adress').style.display = "none";
            document.getElementById('lb_bdd_adress').style.display = "none";

            document.getElementById('bdd_name').style.boxShadow = "white 0 0 10px";

            document.getElementById('user_name').value = 'root';
            document.getElementById('user_name').style.display = "none";
            document.getElementById('lb_user_name').style.display = "none";

            document.getElementById('password').value = "";
            document.getElementById('password').style.display = "none";
            document.getElementById('lb_password').style.display = "none";
        }

        function erase() {
            document.getElementById('bdd_adress').value = '';
            document.getElementById('bdd_adress').style.display = "block";
            document.getElementById('lb_bdd_adress').style.display = "block";

            document.getElementById('bdd_name').style.boxShadow = "white 0 0 0";

            document.getElementById('user_name').value = '';
            document.getElementById('user_name').style.display = "block";
            document.getElementById('lb_user_name').style.display = "block";

            document.getElementById('password').value = "";
            document.getElementById('password').style.display = "block";
            document.getElementById('lb_password').style.display = "block";
        }
    </script>

</head>

<?php

// Partie traitement
// Starting testing phase on the content of object _POST / Début des tests sur l'envoi POST 


if (!empty($_POST)) {

    $bdd_adress = $_POST['bdd_adress'];
    $bdd_name = $_POST['bdd_name'];
    $bdd_name_and_adress = "mysql:host=$bdd_adress;dbname=$bdd_name";
    $user = $_POST['user_name'];
    $password = $_POST['password'];

    //On établit la connexion
    try {

        if ($_POST['bdd_name'] == '') {
            // On lance une nouvelle exception grâce à throw et on instancie directement un objet de la classe Exception.
            throw new Exception('Veuillez rentrer le nom de la bdd');
        }
        // Creation de la bse de donné si elle n'éxiste pas
        $create_req = new PDO('mysql:host='.$bdd_adress, $user, $password);
        $create_req->query('CREATE DATABASE IF NOT EXISTS '.$bdd_name);

        // Dans touts les cas test de connexion a la base en question
        $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES utf8';
        $pdo = new PDO($bdd_name_and_adress, $user, $password, $pdo_options);

        //On définit le mode d'erreur de PDO sur Exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Création du fichier
        $myfile = fopen("info.db.php", "w+");
        fwrite($myfile, '<?php $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = \'SET NAMES utf8\';
        $pdo = new PDO(\'' . $bdd_name_and_adress . '\', \'' . $user . '\', \'' . $password . '\', $pdo_options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);');
        fclose($myfile);
?>

        <div class="alert alert-success m-0" role="alert">
            <h4 class="alert-heading">Felicitation !</h4>
            <p>La connexion avec la base de donnée : <strong><?= strtoupper($bdd_name); ?></strong> s'est effectué avec succès !</p>
            <hr>
            <div class="card border-success mb-3">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                        <strong>Dernière étape :</strong><em title="En vérifiant les informations">Vous pouvez désormais cliquez sur ce bouton afin de procéder au déploiement de l'application !</em>
                        <a href="../Sql/WB_sql.deploy.php"><button class="btn btn-success btn-smbtn-success " data-toggle="collapse" data-target="#returned_error" aria-expanded="false" aria-controls="returned_info">
                                Déployer !
                            </button></a>
                    </h5>
                </div>

            </div>
        </div>
        <script>
            document.getElementById('form_container').style.filter = "blur(4px)"
        </script>

    <?php
    }

    /*On capture les exceptions si une exception est lancée et on affiche
             *les informations relatives à celle-ci*/ catch (Exception $e) {

    ?>

        <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">

            <div class="card border-danger mb-3">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                        <strong>Malheuresement la connexion a échouée </strong><em title="En vérifiant les informations">Veuillez réessayer !</em>
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
}

?>

<body>

    <div id="form_container" class="d-flex">

        <div id="section_form">
            <h2 class="title" style="font-size: 2em;font-weight:bold;text-align:center;text-shadow:black 0 0 1px">Wilber !</h2>
            <h5 class="title" style="text-align:center;">BIENVENUE </h2>
                <div id="image_entete">
                    <img src="../Mascot.jpg" alt="image_mascot">
                </div>
                <div class="d-flex justify-content-between m-2">
                    <h2 class="title">Configuration</h2> <button id="button_erase_form" style="" title="Reinitialiser le formulaire" class="oi oi-action-undo btn" onclick="erase()"></button>
                </div>

                <form action="" method="post">

                    <div class="form-group">
                        <label id="lb_bdd_adress" for="bdd_adress"><span title="l'adresse de votre base de donné / si vous êtes en local veuillez taper : localhost " class="oi oi-question-mark btn btn-success"></span> Adresse BDD / HOST :</label>
                        <input class="form-control" type="text" value="" name="bdd_adress" id="bdd_adress" placeholder="">
                    </div>
                    <div class="form-group">
                        <label id="lb_bdd_name=" nom"><span title="Le nom que vous avez choisit pour votre base de donné vous seul le connaissez ! " class="oi oi-question-mark btn btn-success"></span> Nom de la BDD : </label>
                        <input class="form-control" type="text" value="" name="bdd_name" id="bdd_name" placeholder="Le nom de la base de donnée">
                    </div>
                    <div class="form-group">
                        <label id="lb_user_name" for="nom">Utilisateur : </label>
                        <input class="form-control" type="text" value="" name="user_name" id="user_name" placeholder="Utilisateur">
                    </div>
                    <div class="form-group">
                        <label id="lb_password" for="nom">Password : </label>
                        <input class="form-control" type="password" value="" name="password" id="password" placeholder="">
                    </div>

                    <textarea id="comment" name="comment" class="form-control" placeholder="Un petit commentaire pour l'auteur fait toujours plaisir (bientôt)" disabled></textarea>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div id="button_autoFill" style="" title="Auto remplir le formulaire / configuration local" class="oi oi-media-skip-forward btn" onclick="autofill()">Auto-fill<br>localhost/default</div>
                        <button style="background-color:aquamarine;color:black;" class="btn btn-success" type="submit">Valider ! </button>
                    </div>
                </form>


        </div>

    </div>

    <script src="bootstrap/js/jquery-3.4.1.min.js"></script>

    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>