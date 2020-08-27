<?php

class toolbox{

   static public function clean($string) {
      $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   
      return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   }
}



// Credit https://stackoverflow.com/users/1726801/terry-harvey