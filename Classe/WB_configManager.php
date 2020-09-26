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


        <div class="container-fluid list_main_container">
            <div class="row list_item_header">
                <div class="col-2" class="user_item_pseudo">ID</div>
                <div class="col-2" class="user_item_pseudo">PSEUDO</div>
                <div class="col-2" class="user_item_mail">MAIL</div>
                <div class="col-2" class="user_item_role">DATE INSCRIPTION</div>
                <div class="col-4">Option</div>
            </div>




            <?php
            $i = 0;
            foreach (userManager::$list_user as $value) {
            ?>
                <div class="row list_item_container">
                    <div class="col-2" title="L'id de l'utilisateur" class="user_item_pseudo"><button class="card" data-toggle="collapse" data-target="#<?php echo "list_item_" . $value->getId() ?>" aria-expanded="false" aria-controls="<?php echo "list_item_" . $value->getId() ?>"><?= $value->getId(); ?></button></div>
                    <div class="col-2" title="Le pseudo de l'utilisateur" class="user_item_pseudo"><?= $value->getPseudo(); ?></div>
                    <div class="col-2" title="Le mail de : <?= $value->getPseudo(); ?>" class="user_item_mail"><?= $value->getMail(); ?></div>
                    <div class="col-2" class="user_item_role"><?= $value->getDate_post(); ?></div>

                    <div class="col-2" title="Modifier l'article">
                        <a class="button edit_button" href="<?= strtok($_SERVER['REQUEST_URI'], '?') . "?article_id=" . $value->getId(); ?>">
                            Modifier
                        </a>
                    </div>
                    <div class="col-2" title="Supprimer l'article (ireversible)">
                        <a class="button delete_button" href="sql/WB_sql_treatment.php?user_del_id=<?= $value->getId(); ?>&url_origin=<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>">
                            Suprimer
                        </a>
                    </div>

                    <div id="<?php echo "list_item_" . $value->getId() ?>" class="collapse" aria-labelledby="headingOne">
                        <div class="card-body">Bientôt ici la possibilité de modifier plus de contenu</div>
                    </div>
                </div>
            <?php
            }
            echo '</div>';
        }

        public static function generate_article_list()
        {
            if (empty(dataManager::$list_item_data['article'])) {
                dataManager::pull_data("article");
                // var_dump(userManager::$list_user);
            }
            ?>


            <form action="Sql/WB_sql_treatment.php" method="POST" class="container-fluid list_main_container">
                <div class="row list_item_header">
                    <div class="col-2">ID</div>
                    <div class="col-2">Titre</div>
                    <div class="col-2">Auteur</div>
                    <div class="col-2">Categorie</div>
                    <div class="col-2">Visibilité</div>
                    <button class="col-2 wilber_button">Appliquer changement</button>
                </div>




                <?php
                foreach (dataManager::$list_item_data['article'] as $value) {
                ?>
                    <div class="row list_item_container">
                        <div class="col-2" title="L'id de l'article"><button name="<?php echo $value->getId() . "_article_id" ?>" type="button" class="card" data-toggle="collapse" data-target="#<?php echo "list_item_" . $value->getId() ?>" aria-expanded="false" aria-controls="<?php echo "list_item_" . $value->getId() ?>"><?php echo $value->getId()?></button></div>
                        <input name="<?php echo $value->getId() . "_article_title" ?>" class="col-2" title="Le titre de l'article" value="<?= $value->getTitle(); ?>">
                        <input name="<?php echo $value->getId() . "_article_author" ?>" class="col-2" title="L'auteur de l'article" value="<?= $value->getAuthor(); ?>">
                        <select name="<?php echo $value->getId() . "_article_category" ?>" class="col-2 border-0" title="La catégorie de l'article" value="<?= $value->getCategory(); ?>">
                            <option>Le module</option>
                            <option>L'auteur</option>
                            <option>Dans le futur</option>
                        </select>


                        <div class="col-2">
                            <label class="switch">
                                <input name="<?php echo $value->getId() . "_article_visibility" ?>" type="checkbox" value="1" <?php if ($value->getVisibility() == 1) {
                                                                                                echo "checked";
                                                                                            } ?>>
                                <span class="slider round"></span>
                            </label>

                        </div>
                        <div class=" col-2">
                            <div class="row">

                                <!-- <div class="col-6" title="Modifier l'article">
                                    <a class="button edit_button" href="<?= strtok($_SERVER['REQUEST_URI'], '?') . "?article_id=" . $value->getId(); ?>">
                                        Modifier
                                    </a>
                                </div> -->
                                <div class="col-12" title="Supprimer l'article (ireversible)">
                                    <a class="button delete_button" href="sql/WB_sql_treatment.php?article_del_id=<?= $value->getId(); ?>&url_origin=<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>">
                                        Suprimer
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div id="<?php echo "list_item_" . $value->getId() ?>" class="collapse list_item_modify_form" aria-labelledby="headingOne">
                            <div class="card-body">coucou</div>
                        </div>

                    </div>

        <?php
                }
                echo '</form>';
            }
        }
