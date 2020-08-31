<?php

require "config.php";
require "WB_Toolbox.php";

switch($_GET){

    case isset($_GET['article_del_id']):
 
        $q = $pdo->prepare('DELETE FROM article WHERE id = ?');
        $q->execute([$_GET['article_del_id']]);

        try{

            toolbox::rrmdir("Posts_images/Article/".$_GET['folder_adress']);
        }catch(Exception $e){
            echo $e;
        }
        
        header("location: ".$_GET['url_origin']);
    break;

}