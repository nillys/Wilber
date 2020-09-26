<?php


class toolbox
{

   static public function clean($string)
   {
      $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

      return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

      // Credit https://stackoverflow.com/users/1726801/terry-harvey
   }

   static public function rrmdir($dir)
   {

      if (is_dir($dir)) { // si le paramètre est un dossier
         $objects = scandir($dir); // on scan le dossier pour récupérer ses objets
         foreach ($objects as $object) { // pour chaque objet
            if ($object != "." && $object != "..") { // si l'objet n'est pas . ou ..
               if (filetype($dir . "/" . $object) == "dir") rmdir($dir . "/" . $object);
               else unlink($dir . "/" . $object); // on supprime l'objet
            }
         }
         reset($objects); // on remet à 0 les objets
         rmdir($dir); // on supprime le dossier
      }
   }

   static public function generate_token($length)
   {

      $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
      return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
   }

   static public function parse_post()
   {
      $_POST_elements = array();
      $current_index = null;

      if (isset($_POST)) {
         foreach ($_POST as $key => $value) {
            if (ctype_digit(explode("_", $key)[0])) {

               if ($current_index == null or $current_index != explode("_", $key)[0]) {
                  $current_index = explode("_", $key)[0];
               };

               $_POST_elements[$current_index][explode("_", $key)[1] . "_" . explode("_", $key)[2]] = $value;
            }
         }
      }
      return $_POST_elements;
   }

   static public function launch_session()
   {
      if (session_status() == PHP_SESSION_NONE) {
         session_start();
      }
   }

   static public function write_flash_message($message, $type)
   {
      $_SESSION['flash'][$type] = $message;
   }

   static public function show_flash_message()
   {
      if (isset($_SESSION['flash'])) {
         foreach ($_SESSION['flash'] as $type => $message) {
?>
            <div style="margin-bottom:0;" class="alert alert-<?=$type?> alert-dismissible fade show" role="alert">
               <strong> <?= $message?></strong>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
<?php

         }
         unset($_SESSION['flash']);
      }
   }

   //Credit http://frankbecu.unblog.fr/2015/02/17/fonction-de-suppression-dun-dossier-non-vide-php/

}
