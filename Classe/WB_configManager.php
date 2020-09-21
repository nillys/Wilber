<?php

class configManager
{

    public static function generate_user_list()
    {
        if (empty(userManager::$list_user)) {
            userManager::pull_users();
            // var_dump(userManager::$list_user);
        }
?>


        <table class="table table-striped table-responsive-lg">
            <thead class="thead-dark">
                <tr>
                    <th class="user_item_pseudo">ID</th>
                    <th class="user_item_pseudo">PSEUDO</th>
                    <th class="user_item_mail">MAIL</th>
                    <th class="user_item_password">MDP</th>
                    <th class="user_item_role">DATE</th>
                    <th>Modifier</th>
                    <th>Effacer</th>
                </tr>
            </thead>
            <!-- 
            <div class="card bg-primary mb-3">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                        <strong>Malheuresement la connexion a échouée </strong><em title="En vérifiant les informations">Veuillez réessayer !</em>
                        <button class="btn btn-danger btn-smbtn-danger " data-toggle="collapse" data-target="#returned_error" aria-expanded="false" aria-controls="returned_error">
                            Voir l'érreur retournée !
                        </button>
                        </h2>
                </div>

                <div id="returned_error" class="collapse" aria-labelledby="headingOne">
                    <div class="card-body">coucou</div>
                </div>
            </div> -->

            <tbody class="table-hover">
                <?php
                $i = 0;
                foreach (userManager::$list_user as $value) {
                ?>
                    <tr style="background-color:white;">
                        <th scope="row" title="L'id de l'utilisateur" class="user_item_pseudo"><button class="card" data-toggle="collapse" data-target="#<?php echo "list_item_" . $value->getId() ?>" aria-expanded="false" aria-controls="<?php echo "list_item_" . $value->getId() ?>"><?= $value->getId(); ?></button></th>
                        <td title="Le pseudo de l'utilisateur" class="user_item_pseudo"><?= $value->getPseudo(); ?></td>
                        <td title="Le mail de : <?= $value->getPseudo(); ?>" class="user_item_mail"><?= $value->getMail(); ?></td>
                        <td class="user_item_password">Changer mot de passe</td>
                        <td class="user_item_role"><?= "Enregistré le : " . $value->getDate_post(); ?></td>

                        <td title="Modifier l'article">
                            <a class="button edit_button" href="<?= strtok($_SERVER['REQUEST_URI'], '?') . "?article_id=" . $value->getId(); ?>">
                                Modifier
                            </a>
                        </td>
                        <td title="Supprimer l'article (ireversible)">
                            <a class="button delete_button" href="sql/WB_sql_treatment.php?user_del_id=<?= $value->getId(); ?>&url_origin=<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>">
                                Suprimer
                            </a>
                        </td>
                    </tr>
                    

                    <tr style="background-color:white;" class="collapse " id="<?php echo "list_item_" . $value->getId() ?>" aria-labelledby="<?php echo "list_item_" . $value->getId() ?>">
                            <div class="list_item_modify_form">
                                qsdfsdqf
                            </div>
                    </tr>
        <?php
                }
                echo '</tbody></table>';
            }
        }
