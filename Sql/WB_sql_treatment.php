<?php


require "../Wilber.php";


// POST STATMENT 

if($_POST){
    $posted_elements = toolbox::parse_post();
    var_dump($posted_elements);

    if(!empty($posted_elements)){
        $data_statment = new formManager;
        foreach($posted_elements as $posted_elements){
            $data_statment->processing_data_form("article",$posted_elements);
        }
        
    }else{
        $data_statment = new formManager;
        $data_statment->processing_data_form("article",$_POST);
    }

    die();
}



// GET STATMENT 

    if(isset($_GET['article_del_id'])){
        echo "oui";
        $q = DB::$pdo->prepare('DELETE FROM article WHERE id = ?');
        $q->execute([$_GET['article_del_id']]);

        if ($_GET['folder_adress'] != "") {
            try {

                toolbox::rrmdir("Posts_images/Article/" . $_GET['folder_adress']);
            } catch (Exception $e) {
                echo $e;
            }
        }

    }


    if(isset($_GET['comment_del_id'])){
        $q = DB::$pdo->prepare('DELETE FROM comment WHERE id = ?');
        $q->execute([$_GET['comment_del_id']]);

    }

    if(isset($_GET['user_del_id'])){
        echo "oui";
        $q = DB::$pdo->prepare('DELETE FROM user WHERE id = ?');
        $q->execute([$_GET['user_del_id']]);

    }

    if(isset($_GET['confirmation_token'])){
        $q = DB::$pdo->prepare("SELECT confirmation_token FROM user WHERE id = ? ");
        $q->execute([$_GET['user_id']]);
        $result = $q->fetch();


        if($result->confirmation_token == $_GET['confirmation_token']){
            $q = DB::$pdo->prepare('UPDATE USER SET confirmation_token = NULL,confirmed_at = NOW() WHERE id = ?')->execute([$_GET['user_id']]);
            toolbox::write_flash_message("Felicitation ". userManager::connected_name()." Vous avez confirmé votre compte avec succès","success");
        }
    }
    if(isset($_GET['disconect'])){
        unset($_SESSION['logged_in']);
        toolbox::write_flash_message("Vous avez été déconnecté avec succès ! ","success");
    }
    
    header("location: ../WBP_accueil.php");