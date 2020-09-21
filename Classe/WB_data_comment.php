<?php


class comment extends data
{

    protected $db_table_name = "comment";
    public $db_table_configuration =  '(author,title,body,category) VALUES(:author,:title,:body,:category)';

    public function db_table_name()
    {
        return $this->db_table_name;
    }


    public static function generate_form(int $variant = 1)
    {
        ?>
        <div class="form_container">
            <div class="section_form" id="comment_section_form">

                <div class="data_title">
                    <h2>Espace commentaire</h2> <button class=" oi oi-x btn button_erase_form" style="" title="Effacer le formulaire" onclick="erase_comment_form()"></button>
                </div>

                <form action="" method="post">

                    <div class="form-group">
                        <label for="nom">Nom / Pseudo :</label>
                        <input class="form-control" type="text" value="<?php if (!empty($_POST['comment_author'])) {
                                                                            echo $_POST['comment_author'];
                                                                        } ?>" name="comment_author" id="comment_author" placeholder="votre nom">
                    </div>
                    <div class="form-group">
                        <label for="nom">Rentrer un titre : </label>
                        <input class="form-control" type="text" value="<?php if (!empty($_POST['comment_title'])) {
                                                                            echo $_POST['comment_title'];
                                                                        } ?>" name="comment_title" id="comment_title" placeholder="Le titre du commentaire">
                    </div>
                    <div class="form-group">
                        <label for="category">choisissez une catégorie : </label>
                        <select class="form-control" id="comment_category" name="comment_category">
                            <option>Le blog</option>
                            <option>Les développeur</option>
                            <option>Autres</option>
                        </select>
                    </div>
                    <textarea id="comment_body" name="comment_body" class="form-control" placeholder="Entrez votre commentaire ici"><?php if (!empty($_POST['comment_body'])) {
                                                                                                                                        echo $_POST['comment_body'];
                                                                                                                                    } ?></textarea>
                    <br>
                    <button class="btn btn-success class=" type="submit">Envoyer! </button>
                </form>


            </div>

        </div>



        <?php

        if (!empty($_POST['comment_title'])) {
            $comment_check = new formManager;
            $comment_check->checking_integrity("comment_author", "Auteur");
            $comment_check->checking_integrity("comment_title", "Titre", 0);
            $comment_check->checking_integrity("comment_body", "Corps du texte", 0, [1, 1, 300]);

            $comment_check->processing_data_form("comment");
        }
    }

    // ALL COMMENT // AFFICHER TOUT LES COMMENTAIRES
    //-----------------------------------------------------------------------------------------------------------------------------\\
    public static function show_all_comment()
    {
        if (empty(dataManager::$list_item_data["comment"])) {
            dataManager::pull_data("comment");
        }
        echo '<div class="show_comment_container">';
        foreach (dataManager::$list_item_data["comment"] as $value) {
        ?>
            <div class="comment_container">
                <div class="comment_title_container">
                    <div class="comment_title"><?= $value->title(); ?></div>
                    <a title="Suprimer le commentaire ceci est ireverssible" href="Sql/Wb_sql_treatment.php?comment_del_id=<?= $value->id(); ?>&url_origin=<?php echo strtok($_SERVER['REQUEST_URI'], '?') ?>"><span class="oi oi-x"></span></a>
                </div>
                <div class="comment_header">
                    <div class="comment_author"><?= '<span class="oi oi-person"></span> ' . $value->author(); ?></div>
                    <div class="comment_date"><?= "le : " . $value->date_post(); ?></div>
                </div>

                <div class="comment_body"><?= $value->body(); ?></div>
            </div>

        <?php
        }
        echo '</div>';
    }

    // COMMENT // AFFICHER UN SEUL COMMENTAIRE
    //-----------------------------------------------------------------------------------------------------------------------------\\
    public static function show_comment($key = 0)
    {

        // self::pull();

        if (is_int($key)) {
        ?>
            <div class="comment_container">
                <div class="comment_title"><?= dataManager::$list_item_data["comment"][$key]->title(); ?></div>
                <div class="comment_header">
                    <div class="comment_author"><?= '<span class="oi oi-person"></span> ' . dataManager::$list_item_data["comment"][$key]->author(); ?></div>
                    <div class="comment_date"><?= "le : " . dataManager::$list_item_data["comment"][$key]->date_post(); ?></div>
                </div>

                <div class="comment_body"><?= dataManager::$list_item_data["comment"][$key]->body(); ?></div>
            </div>
<?php
        }
    }
} // COMMENT