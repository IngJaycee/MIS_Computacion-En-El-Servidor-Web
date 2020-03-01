<?php
require_once('dataBaseModel.php');
class CredentialsModel {
    public $dataBaseModel;
    public function __construct()
    {
        $this->dataBaseModel = new DatabaseModel();
    }

    private function readValidCredentials()
    {
        $filePath = "file/secret.txt";
        $myfile = fopen($filePath, "r") or die("Unable to open file!");
        $secret = fread($myfile,filesize($filePath));
        fclose($myfile);
        $userPass= array();
        if (!empty($secret)){
            $splittedCredentials = explode("||", $secret);

            foreach ($splittedCredentials as $userData) {
                $data = explode("|", $userData);
                $userPass[$data[0]] = $data[1];
            }
        }

        return $userPass;
    }

    public function getLogin()
    {
        if(isset($_REQUEST['mUser']) && isset($_REQUEST['mPass'])){
            $user = $_REQUEST['mUser'];
            $pass = $_REQUEST['mPass'];

            if ($this->isValidCredential($user, $pass)){
                return "LOGIN_OK";
            }else{
                return "LOGIN_FAIL";
            }
        }
        else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['register']){
            return $this->getTypeOfRegister();
        }
        else{
            return "LOGIN_NO_DATA";
        }
    }

    public function getTypeOfRegister()
    {
        if(!isset($_REQUEST['regUser']) && !isset($_REQUEST['regPass'])){
            return "REGISTER";
        }else {
            if(isset($_REQUEST['regUser']) && isset($_REQUEST['regPass'])){
                $newUser = $_REQUEST['regUser'];
                $newPass = $_REQUEST['regPass'];

                return $this->saveNewUser($newUser, $newPass);
            }else{
                return "REGISTER_ERROR";
            }
        }
    }

    public function isValidCredential($user = "", $pass = "")
    {
        $user = strtolower($user);
        $pass = sha1($pass);

        if (empty($user) || empty($pass)){
            return FALSE;
        }
        
        $result = $this->dataBaseModel->getUserFromDB($user, $pass);

        if (sizeof($result)>0){
            $_SESSION['user'] = $result[0];
            return TRUE;
        }else{
            return FALSE;
        }
    }

    private function saveNewUser($newUser = "", $newPass = "")
    {
        $newUser = strtolower($newUser);
        if (empty($newUser) || empty($newPass) || !$this->dataBaseModel->isUnUsedUser($newUser)){
            return "REGISTER_USED_ERROR";
        }

        if ($this->dataBaseModel->registerNewUser($newUser, sha1($newPass))){
            return "REGISTER_OK";
        } else{
            return "REGISTER_ERROR";
        }
    }

    public function removeUser()
    {
        $user = $_SESSION["user"];
        $this->dataBaseModel->deleteUser($user["id"], $user["password"]);
    }

    public function updateUser(){
        $user = $_SESSION["user"];
        $usuario = $_REQUEST['mUser'];
        $password = $_REQUEST['mPass'];
        $mFullName = $_REQUEST['mFullName'];

        if ($this->dataBaseModel->updateUser($user["id"], $usuario, $password, $mFullName)){
            $_SESSION['user']["name"] = $usuario;
            $_SESSION['user']["fullname"] = $mFullName;
        }
    }
}
?>