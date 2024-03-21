<?php

require_once __DIR__ . '/../includes/dbh.inc.php';

class ContactForm extends dbConnect {
    private $name;
    private $email;
    private $message;
    private $created_at;
    protected $dbconn; 

    public function __construct($name = '',$message = '', $email = '', $created_at = '') {
        $this->name = $name;
        $this->message = $message;
        $this->email = $email;
        $this->created_at = $created_at;

        $this->dbconn=$this->connect();
    }

    public function getName(){
        return $this->name;
     }

    public function setName($name){
        $this->name = $name;
    }

    public function getMessage(){
        return $this->message;
     }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getEmail(){
        return $this->email;
     }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getCreatedAt(){
        return $this->created_at;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function setContactForm() {
        $sql="INSERT INTO messages (name, message, email, created_at) VALUES (?, ?, ?, ?)";
        $stmt=$this->dbconn->prepare($sql);
        $stmt->execute([$this->name, $this->message, $this->email, $this->created_at]);
    }

    public function getEmails(){
        $sql = 'SELECT * FROM messages';
        $stm = $this->dbconn->prepare($sql);
        $stm->execute();
        $results = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}