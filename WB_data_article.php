<?php

class article extends data



{

    protected $db_table_name = "articfle";
    public $db_table_configuration = '(author,title,body,category,article_picture1,article_picture2,article_picture3) VALUES(:author,:title,:body,:category,:article_picture1,:article_picture2,:article_picture3)';
    public $db_table_update = 'author = :author,title = :title,body = :body, category = :category,article_picture1 = :article_picture1,article_picture2 = :article_picture2, article_picture3 = :article_picture3';

    public function custom_request_data_parameters($q, $data_received)
    {
        $q->bindValue(':article_picture1', $data_received->article_picture1_name);
        $q->bindValue(':article_picture2', $data_received->article_picture2_name);
        $q->bindValue(':article_picture3', $data_received->article_picture3_name);
    }
    public $article_picture1_name, $article_picture2_name, $article_picture3_name;


    public function db_table_name()
    {
        return $this->db_table_name;
    }

    public function __construct($title_or_data, $author = "", $body = "", $category = "", $article_picture1 = "", $article_picture2 = "", $article_picture3 = "", $id = "", $date_post = "")
    {
        //Traitement dans le cas de l'hydratation de l'objet manuellement !

        if (is_string($title_or_data)) {
            $this->setTitle($title_or_data);
            $this->setAuthor($author);
            $this->setBody($body);
            $this->setCategory($category);
            $this->setDate_post($date_post);
            $this->article_picture1_name = $article_picture1;
            $this->article_picture2_name = $article_picture2;
            $this->article_picture3_name = $article_picture3;
        }
        //Traitement dans le cas de l'hydratation de l'objet avec un tableau
        elseif (is_array($title_or_data)) {
            $this->setTitle($title_or_data['title']);
            $this->setAuthor($title_or_data['author']);
            $this->setBody($title_or_data['body']);
            $this->setCategory($title_or_data['category']);
            $this->setId($title_or_data['id']);
            $this->article_picture1_name = $title_or_data['article_picture1'];
            $this->article_picture2_name = $title_or_data['article_picture2'];
            $this->article_picture3_name = $title_or_data['article_picture3'];
            $this->setDate_post($title_or_data['date_post']);
        }
    }

    public static function generate_form(int $variant = 1)
    {
        if (isset($_GET['article_id'])) {
            // pull_item_from_db prend en paramètre le nom de la table et l'id
            $current_article_dump = dataManager::pull_item_from_db('article', $_GET['article_id']);
            var_dump($current_article_dump);
         }
?>
        <div class="form_container" class="d-flex">

            <div class="section_form" id="article_section_form">

                <div class="data_title">
                    <h2>Espace ARTICLE</h2> <button class=" oi oi-x btn button_erase_form" style="" title="Effacer le formulaire" onclick="erase_article_form()"></button>
                </div>

                <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-row">
                        <div class="col-md-6">

                            <label for="title">Rentrer un titre : </label>
                            <input class="form-control" type="text" value="<?php if (!empty($_POST['article_title'])) {
                                                                                echo $_POST['article_title'];
                                                                               
                                                                            } elseif (isset($current_article_dump)) {
  
                                                                                ;
                                                                                echo $current_article_dump->title;
                                                                            } ?>" name="article_title" id="article_title" placeholder="Le titre de l'article">
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="category">Choisissez une catégorie : </label>
                                <select class="form-control" id="article_category" name="article_category">
                                    <option>Le module</option>
                                    <option>L'auteur</option>
                                    <option>Dans le futur</option>
                                </select>
                            </div>
                        </div>
                        <div class=" col-md-2 form-group">
                            <label for="nom">Nom / Pseudo : </label>
                            <input class="form-control" type="text" value="<?php if (!empty($_POST['article_author'])) {
                                                                                echo $_POST['article_author'];
                                                                            } elseif (isset($current_article_dump)) {
                                                                                echo $current_article_dump->author;
                                                                            } ?>" name="article_author" id="article_author" placeholder="votre nom">
                        </div>



                        <div class="col-md-2 form-group">


                            <label>Mode : </label>


                            <?php if (isset($_GET['article_id'])) : ?>
                                <div class="select_article_processing_mode select_edit_article_mode">
                                    <div class="info_article_mode ">MODIFIER L'ARTICLE : </div>
                                    <div class="select_show_article_name">
                                        <quote>"<?= $current_article_dump->title ?>"</quote>
                                    </div>
                                    <a href="<?= strtok($_SERVER['REQUEST_URI'], '?') ?>">
                                        <div class="select_show_article_btn delete_button"><span class="oi oi-x"></span></div>
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="select_article_processing_mode select_new_article_mode">
                                    <div class="info_article_mode select_new_article_mode">NOUVELLE ARTICLE</div>
                                </div>

                            <?php endif ?>

                            <!-- <div class="form-check form-check-inline">
                                    <input type="radio" name="processing_mode" id="processing_mode_new" value="new" checked="checked">
                                    <label class="form-check-label" for="inlineRadio1"> Nouvelle article </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="processing_mode" id="processing_mode_edit" value="edit" <?php if (isset($_GET['article_id'])) {
                                                                                                                            echo 'checked="checked"';
                                                                                                                        } ?>
                                    <label class="form-check-label" for="inlineRadio2"> Modifier l'article</label>
                                </div> -->



                        </div>
                    </div>



                    <textarea id="article_body" name="article_body" class="form-control" placeholder="Entrez le corps de l'article ici">
                    </textarea>
                    <!-- ! la seul façon de renvoyé le texte de tiny mce a été de placer l'instruction adéquate dans la fonction d'initialisation -->
                    <script src="Ressource_code/tinymce_5.4.2/tinymce/js/tinymce/tinymce.min.js"></script>
                    <script type="text/javascript">
                        tinymce.init({
                            selector: '#article_body',
                            init_instance_callback: function(editor) {
                                <?php if (!empty($_POST['article_body'])) {
                                    echo 'tinymce.get("article_body").setContent("'. str_replace(array("\n", "\r"), "", addslashes($_POST['article_body'])).'")';
                                } elseif (isset($current_article_dump)) {
                                    // echo 'tinymce.get("article_body").setContent("' . addcslashes($current_article_dump->body,'"',"'",).'")';
                                    // Très important : le module tinymce génère des érreurs si le texte réintroduit comporte des blanc ou des saut de ligne tel qu'inséré dans mysql
                                    echo 'tinymce.get("article_body").setContent("' . str_replace(array("\n", "\r"), "", addslashes($current_article_dump->body)) . '")';
                                    // echo 'tinymce.get("article_body").setContent("' . $current_article_dump->body.'")';
                                    // echo 'tinymce.get("article_body").setContent("<pre>\n\ncoucou"</pre>)';
                                }
                                ?>

                                console.log('Editor: ' + editor.id + ' is now initialized.');
                            }
                        });
                    </script>
                    <br>

                    <input type="file" name="article_picture1" id="article_picture1" value>
                    <button class="btn btn-success class=" type="submit"><?php if(isset($_GET['article_id'])){
                        $_POST['article_picture1_name'] = $current_article_dump->article_picture1;
                        echo "Modifier !";}else{echo "Envoyer !";}?></button>
                </form>


            </div>

        </div>
<?php
        return "article";
    }
} // article