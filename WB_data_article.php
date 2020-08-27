<?php

class article extends data


{

    protected $db_table_name = "article";
    public $db_table_configuration = '(author,title,body,category,article_picture1,article_picture2,article_picture3) VALUES(:author,:title,:body,:category,:article_picture1,:article_picture2,:article_picture3)';
    
    public function custom_request_data_parameters($q,$data_received){
        $q->bindValue(':article_picture1', $data_received->article_picture1_name);
            $q->bindValue(':article_picture2', $data_received->article_picture2_name);
            $q->bindValue(':article_picture3', $data_received->article_picture3_name);
    }
    public $article_picture1_name, $article_picture2_name, $article_picture3_name;


    public function db_table_name()
    {
        return $this->db_table_name;
    }

    public function __construct($title_or_data, $author = "", $body = "", $category = "",$article_picture1="", $article_picture2="", $article_picture3="", $date_post = "")
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
            $this->article_picture1_name = $title_or_data['article_picture1'];
            $this->article_picture2_name = $title_or_data['article_picture2'];
            $this->article_picture3_name = $title_or_data['article_picture3'];
            $this->setDate_post($title_or_data['date_post']);
        }
 
    }

    public static function generate_form(int $variant = 1)
    {
    ?>
        <div class="form_container" class="d-flex">
            <div class="section_form" id="article_section_form">

                <div class="data_title">
                    <h2>Espace ARCTICLE</h2> <button class=" oi oi-x btn button_erase_form" style="" title="Effacer le formulaire" onclick="erase_article_form()"></button>
                </div>

                <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-row">
                        <div class="col">

                            <label for="title">Rentrer un titre : </label>
                            <input class="form-control" type="text" value="<?php if (!empty($_POST['article_title'])) {
                                                                                echo $_POST['article_title'];
                                                                            } ?>" name="article_title" id="article_title" placeholder="Le titre de l'article">
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="category">Choisissez une catégorie : </label>
                                <select class="form-control" id="article_category" name="article_category">
                                    <option>Le module</option>
                                    <option>L'auteur</option>
                                    <option>Dans le futur</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom / Pseudo : </label>
                        <input class="form-control" type="text" value="<?php if (!empty($_POST['article_author'])) {
                                                                            echo $_POST['article_author'];
                                                                        } ?>" name="article_author" id="article_author" placeholder="votre nom">
                    </div>
                    <textarea id="article_body" name="article_body" class="form-control" placeholder="Entrez le corps de l'article ici"><?php if (!empty($_POST['article_body'])) {
                                                                                                                                            echo $_POST['article_body'];
                                                                                                                                        } ?></textarea>
                    <br>

                    <input type="file" name="article_picture1" id="article_picture1">
                    <button class="btn btn-success class=" type="submit">Envoyer! </button>
                </form>


            </div>

        </div>
    <?php
        return "article";
    }
} // article