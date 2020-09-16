<?php
if (!file_exists("config.db.php")) {
    header('location: WB_start.php');
}
require "config.db.php";
require "classe/WB_Toolbox.php";

switch ($_GET) {

    case isset($_GET['article_del_id']):

        $q = $pdo->prepare('DELETE FROM article WHERE id = ?');
        $q->execute([$_GET['article_del_id']]);

        if($_GET['folder_adress'] !=""){
            try {

                toolbox::rrmdir("Posts_images/Article/" . $_GET['folder_adress']);
            } catch (Exception $e) {
                echo $e;
            }
        }
        

        header("location: " . $_GET['url_origin']);
        break;

    
    case isset($_GET['comment_del_id']):
        echo "yes";
        $q = $pdo->prepare('DELETE FROM comment WHERE id = ?');
        $q->execute([$_GET['comment_del_id']]);

        header("location: " . $_GET['url_origin']);
        break;
}
