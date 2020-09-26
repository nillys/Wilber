<?php

class userManager
{

    public static $list_user = array();

    public static function add_user($user_received)
    {


        $q = DB::$pdo->prepare('INSERT INTO ' . $user_received->db_table_name() . $user_received->db_table_configuration);

        // Partie Commune
        // Affection des paramètres commun aux objet data
        $q->bindValue(':pseudo', $user_received->getPseudo());
        $q->bindValue(':mail', $user_received->getMail());
        $q->bindValue(':password', $user_received->getPassword());
        $q->bindValue(':role', $user_received->getRole());
        $q->bindValue(':confirmation_token',$user_received->getConfirmation_token()) ;

        // Partie Particulière
        // Cette fonction est chargé d'éxecuter les parties de requettes propres aux objets traité qui dispose de paramètres suplémentaires 
        if (method_exists($user_received, "custom_request_data_parameters")) {
            $user_received->custom_request_data_parameters($q, $user_received);
        }

        $q->execute();
    }

    public static function pull_users()
    {
        // Selectionner la table qui corespond aux dernier mode !!!
        // Desc signifie inverser l'ordre de trie

        $q = DB::$pdo->prepare('SELECT * FROM user ORDER BY id DESC');
        $q->execute();

   
                while ($result = $q->fetch(PDO::FETCH_ASSOC)) {
                    self::$list_user[] = new user($result);
                }
             
        // Ici l'objet pdo est converti en tableau car l'objet data prend un tableau en entré


      
    }

    public static function is_connected(){
        if(isset($_SESSION['logged_in'])){
            return true;
        }else{
            return false;
        }
    }
    public static function connected_name(){
        if(isset($_SESSION['logged_in'])){
            var_dump($_SESSION['logged_in']);
        }
    }
}
