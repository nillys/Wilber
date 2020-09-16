<?php

class article extends data



{

    protected $db_table_name = "article";
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
                                                                            } elseif (isset($current_article_dump)) {;
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
                                    echo 'tinymce.get("article_body").setContent("' . str_replace(array("\n", "\r"), "", addslashes($_POST['article_body'])) . '")';
                                } elseif (isset($current_article_dump)) {
                                    // echo 'tinymce.get("article_body").setContent("' . addcslashes($current_article_dump->body,'"',"'",).'")';
                                    // Très important : le module tinymce génère des érreurs si le texte réintroduit comporte des blanc ou des saut de ligne tel qu'inséré dans mysql
                                    echo 'tinymce.get("article_body").setContent("' . str_replace(array("\n", "\r"), "", addslashes($current_article_dump->body)) . '")';
                                    // echo 'tinymce.get("article_body").setContent("' . $current_article_dump->body.'")';
                                    // echo 'tinymce.get("article_body").setContent("<pre>\n\ncoucou"</pre>)';
                                }
                                ?>

                                // console.log('Editor: ' + editor.id + ' is now initialized.');
                            }
                        });
                    </script>
                    <br>

                    <input type="file" name="article_picture1" id="article_picture1" value>
                    <?php if (isset($_GET['article_id'])) {

                        $_POST['article_picture1_name'] = $current_article_dump->article_picture1;
                    } ?>

                    <button class="btn btn-success class=" type="submit"><?php if (isset($_GET['article_id'])) {
                                                                                echo "Modifier !";
                                                                            } else {
                                                                                echo "Envoyer !";
                                                                            } ?></button>
                </form>


            </div>

        </div>
        <?php
        if (!empty($_POST['article_title'])) {
            $article_check = new form_manager;
            $article_check->checking_integrity("article_author", "Auteur");
            $article_check->checking_integrity("article_title", "Titre", 0);
            $article_check->checking_integrity("article_body", "Corps du texte", 0, [1, 1, 300]);
            $article_check->checking_picture_integrity("article_picture1");

            $article_check->processing_form("article");
        }
    }
    // ARTICLE // AFICHER UN ARTICLE
    //-----------------------------------------------------------------------------------------------------------------------------\\
    public static function show_an_article()
    {
        if (isset($_GET['position_article'])) {


            if (empty(dataManager::$list_item_data["article"])) {
                dataManager::pull("article");
            }
        ?>

            <div class="show_article_container">
                <!-- style="background-image: url('<?= dataManager::$list_item_data["article"][$_GET['position_article']]->article_picture1_name; ?>')" -->

                <div class="article_container">

                    <div class="article_title"><?= dataManager::$list_item_data["article"][$_GET['position_article']]->title(); ?></div>
                    <div class="article_header">
                        <div class="article_author"><?= '<span class="oi oi-person"></span>' . ' : ' . dataManager::$list_item_data["article"][$_GET['position_article']]->author(); ?></div>
                        <div class="article_date"><?= '<span class="oi oi-timer"></span>' . " le : " . dataManager::$list_item_data["article"][$_GET['position_article']]->date_post(); ?></div>
                    </div>

                    <div class="article_container_body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="article_img1" src="<?= dataManager::$list_item_data["article"][$_GET['position_article']]->article_picture1_name; ?>" alt="article_picture1">
                                </div>
                                <div class="col-md-8">
                                    <div class="article_body"><?= dataManager::$list_item_data["article"][$_GET['position_article']]->body(); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="article_">

                    </div>
                </div>
            </div>


        <?php
        }
    }

// ALL ARTICLE // AFFICHER TOUTES LES VIGNETTES ARTICLES
    //-----------------------------------------------------------------------------------------------------------------------------\\
    public static function show_all_article_thumbnail()
    {
        if (empty(dataManager::$list_item_data["article"])) {
            dataManager::pull("article");
        } else {
        }
        ?>

        <div class="row">
            <div class="col-lg-6">
                <h2><span class="oi oi-sort-ascending"></span>filtrer</h2>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Ville : </label>
                    <select id="article_sort" onchange="article_sort()">
                        <option>Tous</option>
                        <option>Le module</option>
                        <option>L'auteur</option>
                        <option>Dans le futur</option>
                    </select>
                </div>
            </div>
        </div>

        <?php
        echo '<div class="thumbnail_show_article_container">';
        foreach (dataManager::$list_item_data["article"] as $key => $value) {
        ?>

            <div class="thumbnail_article_container">
                <a href="WB_show_articles.php?position_article=<?= $key; ?>">
                    <div class="thumbnail_article_img_thumbnail" style="background-image: url('<?= $value->article_picture1_name; ?>')">
                        <div title="<?= $value->title(); ?>" class="thumbnail_article_title"><?= substr($value->title(), 0, 40) . '...'; ?></div>
                        <div title="<?= $value->title(); ?>" class="thumbnail_article_category"><?= substr($value->category(), 0, 40) . '...'; ?></div>
                        <div class="thumbnail_article_header">
                            <div class="thumbnail_article_author"><?= '<span class="oi oi-person"></span> ' . $value->author(); ?></div>
                            <div class="thumbnail_article_date"><?= "le : " . $value->date_post(); ?></div>
                        </div>
                    </div>
                </a>
                <div class="thumbnail_article_container_body">


                    <div class="thumbnail_article_body"><?= $value->body(); ?></div>
                </div>
                <div class="thumbnail_article_footer">

                    <a class="button edit_button" href="<?= strtok($_SERVER['REQUEST_URI'], '?') . "?article_id=" . $value->id(); ?>">
                        <div title="Modifier l'article">Modifier</div>
                    </a>

                    <a class="button delete_button" href="WB_sql_treatment.php?article_del_id=<?= $value->id(); ?>&url_origin=<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>&folder_adress=<?php if (!empty($value->article_picture1_name)) {
                                                                                                                                                                                                    print_r(explode('/', $value->article_picture1_name)[2]);
                                                                                                                                                                                                } ?>">
                        <div title="Supprimer l'article (ireversible)">Suprimer</div>
                    </a>


                </div>
            </div>

<?php
        }
        echo '</div>';
    }
} // article