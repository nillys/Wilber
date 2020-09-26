<?php

class dataManager
{
    //le Pdo fournit par la méthode constructrice
    // list des objets récupéré de la base de donné et stocké ici quand besoin d'êtres utilisé par d'autres fonctions
    public static $list_item_data = ["comment" => array(), "article" => array(), "contact" => array()];

    // La variable super global $_POST est absorbé par la classe c'est un choix . 
    private $current_post;

    // Si cette variable est positive alors partout dans l'éxécution du code les infos de débuggage s'afficheront.
    public static $debugmode;



    public function __construct($current_post, $debugmode = 0)
    {
        $this->current_post = $current_post;

        if ($debugmode) {
            var_dump($current_post);
        }
        self::$debugmode = $debugmode;
    }
    // GETTER

    public function list_item_data()
    {
        return self::$list_item_data;
    }

    //====================================================================================================================================//
    // PARTIE FONCTION LIEES A LA BASE DE DONNEES
    //Les fonctions pour envoyer et recevoir des données depuis la base de donnée
    //-----------------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------------

    // Fonction intéligente qui detecte et rentre des données dans la base de donnée 
    // Elle prend en entrée un objet de donnée (type : article , commentaire, etc)
    public static function add_data($data_received)
    {
        // Traitement approprié au type d'objet (article , commentaire , contact etc)


        $q = DB::$pdo->prepare('INSERT INTO ' . $data_received->db_table_name() . $data_received->db_table_configuration);

        // Partie Commune
        // Affection des paramètres commun aux objet data
        $q->bindValue(':title', $data_received->getTitle());
        $q->bindValue(':author', $data_received->getAuthor());
        $q->bindValue(':body', $data_received->getBody());
        $q->bindValue(':category', $data_received->getCategory());

        // Partie Particulière
        // Cette fonction est chargé d'éxecuter les parties de requettes propres aux objets traité qui dispose de paramètres suplémentaires 
        if (method_exists($data_received, "custom_request_data_parameters")) {
            $data_received->custom_request_data_parameters($q, $data_received);
        }


        $q->execute();
    }

    public static function modify_data($data_received, $id)
    {

        $q = DB::$pdo->prepare('UPDATE ' . $data_received->db_table_name() . ' SET ' . $data_received->db_table_update . ' WHERE id = :id');

        // Partie Commune
        // Affection des paramètres commun aux objet data
        $q->bindValue(':title', $data_received->getTitle());
        $q->bindValue(':author', $data_received->getAuthor());
        $q->bindValue(':body', $data_received->getBody());
        $q->bindValue(':category', $data_received->getCategory());
        $q->bindValue(':slug', $data_received->getSlug());
        $q->bindValue(':visibility', $data_received->getVisibility());
        $q->bindValue(':id', $id);

        // Partie Particulière
        // Cette fonction est chargé d'éxecuter les parties de requettes propres aux objets traité qui dispose de paramètres suplémentaires 
        if (method_exists($data_received, "custom_request_data_parameters")) {
            $data_received->custom_request_data_parameters($q, $data_received);
        }

        $q->execute();
    }

    // Cette fonction hydrate le tableau de donnée
    public static function pull_data($table)
    {
        // Selectionner la table qui corespond aux dernier mode !!!
        // Desc signifie inverser l'ordre de trie
        $q = DB::$pdo->prepare('SELECT * FROM ' . $table . ' ORDER BY id DESC');
        $q->execute();

        switch ($table) {
            case "comment":
                while ($result = $q->fetch(PDO::FETCH_ASSOC)) {
                    self::$list_item_data[$table][] = new comment($result);
                }
                break;
            case "article":

                while ($result = $q->fetch(PDO::FETCH_ASSOC)) {
                    self::$list_item_data[$table][] = new article($result);
                }
                break;
            case "contact":
                while ($result = $q->fetch(PDO::FETCH_ASSOC)) {
                    self::$list_item_data[$table][] = new contact($result);
                }
                break;
        }
        // Ici l'objet pdo est converti en tableau car l'objet data prend un tableau en entré


        if (self::$debugmode == true) {
            echo '<div class="debug_source_item"><strong>DEBUG_WB_Fonction : PULL <br></strong>Affichage du tableau remplit par la fonction à partir de la base de donnée  <br><em>NOTE : PULL est appelé une seul fois dans show_all_comment</em></div>';
            echo '<pre class="debug_vardump">';
            var_dump(self::$list_item_data[$table]);
            echo '</pre>';
        }
    }

    static public function pull_data_from_db($table, $id)
    {


        $q = DB::$pdo->prepare('SELECT * FROM ' . $table . ' WHERE id = ? ');
        $q->execute([$id]);

        $result = $q->fetch();

        return $result;
    }
}
