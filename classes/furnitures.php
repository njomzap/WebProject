<?php

require_once __DIR__ . '/../includes/dbh.inc.php';

class Furnitures extends dbConnect {
    private $title;
    private $description;
    private $image;
    private $author;
    private $author_id;
    private $isFeatured;
    protected $dbconn; 

    public function __construct($title = '',$description = '', $image = '', $author = '', $author_id = '', $isFeatured = false) {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->author = $author;

        $this->dbconn=$this->connect();
    }

    public function setIsFeatured($isFeatured){
        $this->isFeatured = $isFeatured;
    }

    public function getTitle(){
        return $this->title;
     }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getDescription(){
        return $this->description;
     }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getImage(){
        return $this->image;
     }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getAuthorId(){
        return $this->author;
    }

    public function setAuthorId($author_id) {
        $this->author_id = $author_id;
    }

    public function setPost() {
        $sql="INSERT INTO furnitures (title, description, image, author, author_id, is_featured) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt=$this->dbconn->prepare($sql);
        $stmt->execute([$this->title, $this->description, $this->image, $this->author, $this->author_id, $this->isFeatured]);
    }

    public function getAllPosts() {
        $sql = 'SELECT * FROM furnitures';
        $stm = $this->dbconn->prepare($sql);
        $stm->execute();
        $results = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function getUserPosts($author_id) {
        $sql = 'SELECT * FROM furnitures WHERE author_id = :author_id';
        $stm = $this->dbconn->prepare($sql);
        $stm->execute([':author_id' => $author_id]);
        $results = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function getFeaturedPosts() {
        $sql = 'SELECT * FROM furnitures WHERE is_featured = 1';
        $stm = $this->dbconn->prepare($sql);
        $stm->execute();
        $results = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function getPostById($id){
        $sql = 'SELECT * FROM furnitures WHERE id = :id';
        $stm = $this->dbconn->prepare($sql);
        $stm->execute([':id' => $id]);
        $results = $stm->fetch(PDO::FETCH_ASSOC);
        return $results;
    }

    public function deletePostById($id) {
        var_dump($id);
        $sql = 'DELETE FROM furnitures WHERE id = :id';
        $stmt = $this->dbconn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updatePostById($id, $title, $description, $image, $isFeatured) {
        $sql = "UPDATE furnitures SET title = ?, description = ?, image = ? WHERE id = ?";
        $stmt = $this->dbconn->prepare($sql);
        return $stmt->execute([$title, $description, $image, $id]);
    }

    public function setFeaturedStatus($id, $isFeatured) {
        $sql = "UPDATE furnitures SET is_featured = ? WHERE id = ?";
        $stmt = $this->dbconn->prepare($sql);
        return $stmt->execute([$isFeatured, $id]);
    }
}