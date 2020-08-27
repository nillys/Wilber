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
        return "comment";
    }
} // COMMENT