<?php

class toolbox{

   static public function clean($string) {
      $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   
      return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

      // Credit https://stackoverflow.com/users/1726801/terry-harvey
   }

   static public function rrmdir($dir) {

      if (is_dir($dir)) { // si le paramètre est un dossier
          $objects = scandir($dir); // on scan le dossier pour récupérer ses objets
          foreach ($objects as $object) { // pour chaque objet
               if ($object != "." && $object != "..") { // si l'objet n'est pas . ou ..
                    if (filetype($dir."/".$object) == "dir") rmdir($dir."/".$object);else unlink($dir."/".$object); // on supprime l'objet
                   }
          }
          reset($objects); // on remet à 0 les objets
          rmdir($dir); // on supprime le dossier
          }
      }

      //Credit http://frankbecu.unblog.fr/2015/02/17/fonction-de-suppression-dun-dossier-non-vide-php/
}



