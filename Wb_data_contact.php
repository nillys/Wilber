<?php
class contact extends data
{

    protected $db_table_name = "contact";
    public $db_table_configuration =  '(author,title,body,category) VALUES(:author,:title,:body,:category)';

    public function db_table_name()
    {
        return $this->db_table_name;
    }

    /**
     * generate_form
     *
     * @param  mixed $type
     * @param  int $variant Choose wich of form variant generate 
     * @return void
     */
    public static function generate_form(int $variant = 1)
    {
    ?>
        <div class="form_container">
            <div class="section_form" id="contact_section_form">
                <div class="data_title">
                    <h2>Espace COMMENTAIRE</h2> <button class=" oi oi-x btn button_erase_form" style="" title="Effacer le formulaire" onclick="erase()"></button>
                </div>
                <form action="" method="post">

                    <div class="form-group">
                        <label for="nom">Nom / Pseudo :</label>
                        <input class="form-control" type="text" value="<?php if (!empty($_POST['comment_author'])) {
                                                                            echo $_POST['comment_author'];
                                                                        } ?>" name="comment_author" id="contact_author" placeholder="votre nom">
                    </div>
                    <div class="form-group">
                        <label for="nom">Rentrer un titre : </label>
                        <input class="form-control" type="text" value="<?php if (!empty($_POST['comment_title'])) {
                                                                            echo $_POST['comment_title'];
                                                                        } ?>" name="comment_title" id="contact_title" placeholder="Le titre du data">
                    </div>
                    <div class="form-group">
                        <label for="category">choisissez une catégorie : </label>
                        <select class="form-control" id="contact_category" name="comment_category">
                            <option>Le blog</option>
                            <option>Les développeur</option>
                            <option>Autres</option>
                        </select>
                    </div>
                    <textarea id="contact_body" name="comment_body" class="form-control" placeholder="Entrez votre data ici"><?php if (!empty($_POST['comment_body'])) {
                                                                                                                                    echo $_POST['comment_body'];
                                                                                                                                } ?></textarea>
                    <br>
                    <button class="btn btn-success class=" type="submit">Envoyer! </button>
                </form>


            </div>

        </div>
        <?php
        return "contact";
    }
} // contact