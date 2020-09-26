<?php toolbox::show_flash_message() ?>
<nav class="navbar navbar-expand-lg navbar-dark" style=" background-color: rgba(255, 255, 255, 0.397);
    box-shadow: white 0 0 5px;
    margin-bottom: 1em;">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="w-100 d-flex justify-content-md-between align-items-center">
            <ul class="navbar-nav d-flex align-items-center" style=" font-size: larger;font-weight:bold">
                <li class="nav-item <?php if (substr(strrchr($_SERVER['PHP_SELF'], '/'), 1) == "WBP_accueil.php") {
                                        echo "active";
                                    } ?>">
                    <a class="nav-link " href="WBP_accueil.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <!-- <li class="nav-item <?php if (substr(strrchr($_SERVER['PHP_SELF'], '/'), 1) == "WBP_config.php") {
                                                echo "active";
                                            } ?>">
                    <a class="nav-link" href="WBP_config.php">contenu</a>
                </li> -->

                <li class="nav-item <?php if (substr(strrchr($_SERVER['PHP_SELF'], '/'), 1) == "WBP_config.php") {
                                        echo "active";
                                    } ?>">
                    <a class="nav-link" href="WBP_config.php">Config</a>
                </li>

                <?php if (userManager::is_connected()) : ?>
                    <li class="nav-item <?php if (substr(strrchr($_SERVER['PHP_SELF'], '/'), 1) == "WBP_user_account.php") {
                                            echo "active";
                                        } ?>">
                        <a class="nav-link" href="WBP_user_account.php">Espace utilisateur</a>
                    </li>
                <?php endif ?>
            </ul>
            <header id="header">
                <h1 id="main_title">WILBER</h1>
                <h6 id="label_version"><?= about::$WB_version_number; ?></h6>
            </header>
            <div id="utilisateur_menu">
                <?php if (!isset($_SESSION['logged_in'])) : ?>
                    <a class="utilisateur_button" id="utilisateurLogin">
                        <h3>Se connecter</h3>

                        <a href="WBP_user_register.php" class="utilisateur_button" id="utilisateurRegister">
                            <h6>S'inscrire</h6>

                        </a>
                        <div id="utilisateurSubMenu">
                            <form action="" method="POST" class="form login_form d-flex flex-column justify-content-center align-items-center ">
                                <input name="user_login" class="form-control mr-sm-2 text-center" type="login" placeholder="login">
                                <input name="user_password" class="form-control mr-sm-2 text-center" type="password" placeholder="password">
                                <div class="d-flex w-100 justify-content-between">
                                    <button class="wilber_button_action" type="submit" value="login">Connect</button>
                                    <button class="wilber_button_action" id="utilisateurMenuBackward" type="button"><span class="oi oi-action-redo"></span></button>
                                </div>


                            </form>
                            <br>
                        </div>



                        <!-- SI DECONECTE  -->
                    <?php else : ?>
                        <div class="dropdown dropleft">
                            <button class="utilisateur_button " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo "<h4>" . substr($_SESSION['logged_in']->pseudo, 0, 40) . "</h4>" ?>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="WBP_user_account.php">Espace membre</a>
                                <div class="dropdown-divider"></div>
                                <a class="wilber_button" href="Sql/Wb_sql_treatment.php?disconect=true">Déconnexion</a>
                            </div>
                        </div>
                        <div id="utilisateurSubMenu" class="" aria-labelledby="">


                        </div>


                    <?php endif ?>
                    <?php
                    if (!empty($_POST['user_login'])) {
                        $login_form_controler = new formManager;
                        $login_form_controler->checking_integrity("user_password", "mot de passe", 0, 0, 0, 0, array("user_login"), 0);
                        $login_form_controler->processing_user_loggin_form();
                    }
                    ?>
            </div>
        </div>
        <script src="ressource_code/bootstrap/js/jquery-3.4.1.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#utilisateurLogin").click(function() {
                    $("#utilisateurSubMenu").css("display", "flex");
                    $("#utilisateurLogin").hide();
                    $("#utilisateurRegister").hide();
                })
                $("#utilisateurMenuBackward").click(function() {
                    $("#utilisateurSubMenu").css("display", "none");
                    $("#utilisateurLogin").show();
                    $("#utilisateurRegister").show();
                })
            });
        </script>
</nav>