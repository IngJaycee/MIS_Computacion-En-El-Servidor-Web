<?php
class DataBaseConnection {
    private static $INSTANCE = null;

    private $DB_HOST_URL    = "localhost";
    private $DB_USER_NAME   = "epiz_25016279";
    private $DB_PASS        = "B6eeqljrYeZ";
    private $DB_NAME        = "epiz_25016279_mis_servidor_web";

    public $isConnectionSuccess = false;
    public $connection = null;

    private function __construct(){
        $this->initConnection();
    }

    public static function getInstance(){
        if (self::$INSTANCE == null){
            self::$INSTANCE = new DataBaseConnection();
        }

        return self::$INSTANCE;
    }

    private function initConnection(){
        $this->connection = new mysqli($this->DB_HOST_URL, $this->DB_USER_NAME, $this->DB_PASS,$this->DB_NAME);
        
        if (mysqli_connect_error()) {
            $this->isConnectionSuccess = false;
            die("Database connection failed: " . mysqli_connect_error());
        }else{
            $this->isConnectionSuccess = true;
        }
    }

    public function getConnection(){
        return $this->connection;
    }
}
?>