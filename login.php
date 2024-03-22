<?php

require_once('includes/dbh.inc.php');

class Login extends dbConnect {
    private $email;
    private $password;
    protected $dbconn;

    public function __construct($email = '', $password = '') {
        $this->email = $email;
        $this->password = $password;

        $this->dbconn = $this->connect();
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function validateLogin() {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$this->email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($this->password, $user['pwd'])) {
            return true;
        } else {
            return false;
        }
    }
}
