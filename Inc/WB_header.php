<nav class="navbar navbar-expand-lg navbar-dark" style=" background-color: rgba(255, 255, 255, 0.397);
    box-shadow: white 0 0 5px;
    margin-bottom: 1em;">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="w-100 d-flex justify-content-md-between">
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
                <li class="nav-item <?php if (substr(strrchr($_SERVER['PHP_SELF'], '/'), 1) == "WBP_user.php") {
                                        echo "active";
                                    } ?> dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Utilisateur
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="WBP_user.php">Inscription</a>
                        <a class="dropdown-item disabled" href="#">Connexion</a>
                    </div>
                </li>
                <li class="nav-item <?php if (substr(strrchr($_SERVER['PHP_SELF'], '/'), 1) == "WBP_config.php") {
                                        echo "active";
                                    } ?>">
                    <a class="nav-link" href="WBP_config.php">Config</a>
                </li>

            </ul>
            <header id="header">
                <h1 id="main_title">WILBER</h1>
                <h6 id="label_version"><?= about::$WB_version_number; ?></h6>
            </header>

            <form class="form my-2 my-lg-0 d-flex flex-column justify-content-center align-items-center login_form">
                <input class="form-control mr-sm-2 text-center" type="login" placeholder="login">
                <input class="form-control mr-sm-2 text-center" type="mdp" placeholder="password">
                <button class="wilber_button" type="submit">Connect</button>
            </form>
        </div>
    </div>

</nav>