<?php
class DatabaseModel {
public $databaseModel;
    public function __construct() {
        $this->databaseModel = new DatabaseModel();
    }

    // Create connection
    $conn = new mysqli(Constants::DB_HOST_URL, Constants::DB_USER_NAME, Connected::DB_PASS);

    // Check connection
    if (mysqli_connect_error()) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";

    public function getConnection(){
        return $conn;
    }
}
?>