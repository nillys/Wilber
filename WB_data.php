<?php
/**
 * data
 * 
 * A simple comment class that group all usefull attribut and method related to such object
 * Une classe toute simple qui regroupe toutes les méthodes et attribut propres cet élément
 * 
 */

class data
{


    private $title, $author, $body, $category,$id, $date_post;

    public function __construct($title_or_data, $author = "", $body = "", $category = "", $id="", $date_post = "")
    {

        if (is_string($title_or_data)) {
            $this->setTitle($title_or_data);
            $this->setAuthor($author);
            $this->setBody($body);
            $this->setCategory($category);
            $this->setId($id);
            $this->setDate_post($date_post);
        } elseif (is_array($title_or_data)) {
            $this->setTitle($title_or_data['title']);
            $this->setAuthor($title_or_data['author']);
            $this->setBody($title_or_data['body']);
            $this->setCategory($title_or_data['category']);
            $this->setId($title_or_data['id']);
            $this->setDate_post($title_or_data['date_post']);
        }
    }

    

    public function setTitle(string $title)
    {

        $this->title = $title;
    }
    public function setAuthor(string $author)
    {

        $this->author = $author;
    }
    public function setBody(string $body)
    {

        $this->body = $body;
    }
    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    public function setId(int $id){
        $this->id = $id;
    }
    public function setDate_post($date_post)
    {

        $this->date_post = $date_post;
    }
    public function setTable($db_table_name)
    {

        $this->db_table_name = $db_table_name;
    }

    public function title()
    {
        return $this->title;
    }
    public function author()
    {
        return $this->author;
    }
    public function body()
    {
        return $this->body;
    }
    public function category()
    {
        return $this->category;
    }

    public function id(){
        return $this->id;
    }
    public function date_post()
    {
        return $this->date_post;
    }
    public function db_table_name()
    {
        return $this->db_table_name;
    }
} // data