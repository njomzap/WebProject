<?php

require_once './includes/dbh.inc.php';

class Users extends dbConnect {
    private $firstname;
    private $lastname;
    private $age;
    private $gender;
    private $username;
    private $email;
    private $password;
    private $isAdmin;
    protected $dbconn; 

    public function __construct($isAdmin = 0, $firstname = '',$lastname = '', $age = '', $gender = '', $username = '', $email = '', $password = '') {
        $this->isAdmin = $isAdmin;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->age = $age;
        $this->gender = $gender;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;

        $this->dbconn=$this->connect();
    }

    public function setIsAdmin($isAdmin){
        $this->isAdmin = $isAdmin;
    }

    public function getIsAdmin(){
        return $this->isAdmin;
    }

    public function getFirstname(){
        return $this->firstname;
     }

    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }

    public function getLastname(){
        return $this->lastname;
     }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function getAge(){
        return $this->age;
     }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getGender(){
        return $this->gender;
     }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function getUsername(){
        return $this->username;
     }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail(){
        return $this->email;
     }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
     }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setUser() {
        $sql = "INSERT INTO users (is_admin, firstname, lastname, age, gender, username, email, pwd) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->dbconn->prepare($sql);
        $ageValue = $this->age !== '' ? $this->age : null;
        $stmt->execute([$this->isAdmin, $this->firstname, $this->lastname, $ageValue, $this->gender, $this->username, $this->email, $this->password]);

        return $this->dbconn->lastInsertId();
    }

    public function getUserByEmail($email){
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stm = $this->dbconn->prepare($sql);
        $stm->execute([':email' => $email]);
        $results = $stm->fetch(PDO::FETCH_ASSOC);
        return $results;
    }

    public function userExists($username, $email) {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$username, $email]);
        if($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}