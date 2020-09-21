<?php


require "../Wilber.php";


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
    header("location: " . $_GET['url_origin']);