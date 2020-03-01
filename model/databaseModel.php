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

    public function deleteUser($id, $encryptedPass){
        $table = $this::TABLE_USER;
        $where = "id = $id AND password = '$encryptedPass'";

        $result = $this->deleteFromTable($table,  $where);
    }

    public function updateUser($id = "", $user = "", $pass = "", $fullname = ""){
        if ($user == "" || $id == "") die("El nombre de usuario es requerido para la actualizacion: $id, $user, $pass, $fullname");
        $table = $this::TABLE_USER;

        $password = ($pass) ? " password = '". sha1($pass) ."', " : "";
        $setInstructions = "SET name = '$user', $password fullname = '$fullname'";
        $where = "id = $id";

        return $result = $this->updateTable($table, $setInstructions, $where);
    }
}
?>