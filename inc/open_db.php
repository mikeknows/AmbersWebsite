<?php
$servername = 'localhost';
$username = 'root';
$password = '123';
$dbname = 'plymire';

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo $error_message;
    exit();
}

class DBController {

    public $host = "localhost";
    public $user = "root";
    public $password = "123";
    public $database = "plymire";
    public $conn;

    function __construct() {
        $this->conn = $this->connectDB();
    }

    function connectDB() {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        return $conn;
    }

    function runQuery($query) {
        
        $result = mysqli_query($this->conn, $query);
        if ($result != false) {
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        }
        if (!empty($resultset))
            return $resultset;
    }

    function numRows($query) {
        $result = mysqli_query($this->conn, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }

}


?>