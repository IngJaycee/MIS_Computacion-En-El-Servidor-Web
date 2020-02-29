<?php
require_once('db/sqlModel.php');
class DatabaseModel extends SQLModel{

    public function __construct() {
        parent::__construct();
    }

    public function isUnUsedUser($nombre){
        $sql = "SELECT COUNT(id) as count FROM ".$this::TABLE_USER." WHERE name = '$nombre'";
        $result = $this->sqlGenericQuery($sql);

        $boolean = (boolean) $result[0]['count'] == '0';

        return $boolean;
    }

    public function registerNewUser($nombre, $pass){
        $table = $this::TABLE_USER;
        $columns = "`id`, `name`, `password`";
        $values = "NULL, '$nombre', '$pass'";
        
        return $result = $this->inserIntoTable($this::TABLE_USER, $columns, $values);
    }

    public function getUserFromDB($nombre, $pass){
        $sql = "SELECT * FROM ".$this::TABLE_USER." WHERE name = '$nombre' AND password = '$pass'";
        $result = $this->sqlGenericQuery($sql);

        return $result;
    }

}

    // public function getUsers(){
    //     $table = "usuarios";
    //     $where = "1";

    //     $result = $this->selectAllFromTable($table, $where);
    //     var_export($result);
    // }

    // public function insertUser(){
    //     $table = "usuarios";
    //     $columns = "`id`, `name`, `password`";
    //     $values = "NULL, 'claudia', '11111'";

    //     $result = $this->inserIntoTable($table, $columns, $values);
    //     var_export($result);
    // }

    // public function updateUser(){
    //     $table = "usuarios";
    //     $setInstructions = "SET name = 'JC'";
    //     $where = "id = 1";

    //     $result = $this->updateTable($table, $setInstructions, $where);
    //     var_export($result);
    // }

    // public function deleteUser(){
    //     $table = "usuarios";
    //     $where = "id = 7";

    //     $result = $this->deleteFromTable($table,  $where);
    //     var_export($result);
    // }

    // public function generic(){
    //     $sql = "SELECT * FROM `usuarios` WHERE 1";

    //     $result = $this->sqlGenericQuery($sql);
    //     var_export($result);
    // }

?>