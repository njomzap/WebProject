<?php

// $dsn = "mysql:host=localhost;dbname=furnituredb"; 
// $dbusername = "root";
// $dbpassword = "";

// try {
//     $pdo = new PDO($dsn, $dbusername, $dbpassword); // pdo-php data objects
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "Connection failed : " . $e->getMessage();
// }
//  $pdo = new PDO($dsn, $dbusername, $dbpassword);-> we use this line of code to connect to our database, the other code inside the try&catch is for error handling.

class dbConnect {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbName = "furnituredb";
    private $conn =null;

    public function connect() {
        try {
            $this->conn = new PDO( 'mysql:host=' . $this->host . ';dbname=' . $this->dbName, $this->username, $this->password );
            $this->conn->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed : " . $e->getMessage();
        }
        return $this->conn;
    }
}