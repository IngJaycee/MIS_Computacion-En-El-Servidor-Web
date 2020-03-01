<?php
require_once('dataBaseConnection.php');
class SQLModel{
    const TABLE_USER = "usuarios";
    private $conexion;

    public function __construct() {
        $db = DataBaseConnection::getInstance();
        $this->conexion = $db->getConnection();
    }
    
    public function selectAllFromTable($table = null, $where = null){
        if ($table == null || $where == null) die("error in params");
        $sql = "SELECT * FROM `".$table."` WHERE ".$where;

        return $this->mapQueryResponseToArray(mysqli_query($this->conexion, $sql));
    }

    
    public function sqlGenericQuery($query){
        if ($query == null ) die("error in param");

        return $this->mapQueryResponseToArray(mysqli_query($this->conexion, $query));
    }

    public function inserIntoTable($table = null, $columns = null, $values = null){
        if ($table == null || $columns == null || $values == null) die("error in params");
        $sql = "INSERT INTO `".$table."`( ".$columns." ) VALUES( ".$values." )";
        return mysqli_query($this->conexion, $sql);
    }

    public function updateTable($table = null, $setInstructions = null, $where = null){
        if ($table == null || $setInstructions == null || $where == null) die("error in params");

        $sql = "UPDATE `".$table."` ".$setInstructions." WHERE ".$where;

        return mysqli_query($this->conexion, $sql);
    }


    public function deleteFromTable($table = null, $where = null){
        if ($table == null || $where == null) die("error in params");
        $sql = "DELETE FROM `".$table."` WHERE ".$where;

        return mysqli_query($this->conexion, $sql);
    }


    private function mapQueryResponseToArray($sqlQueryResult){
        $responseArray = array();

        if (mysqli_num_rows($sqlQueryResult) > 0) {
            $position = 0;

            while($element = mysqli_fetch_assoc($sqlQueryResult)){
                $responseArray[$position++] = $element;
            }
        } 

        return $responseArray;
    }
}
?>