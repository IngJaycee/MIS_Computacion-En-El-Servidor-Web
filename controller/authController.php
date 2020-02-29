<?php
require_once('model/credentialsModel.php');
require_once('model/dataBaseModel.php');
class AuthController
{
    public $credentialsModel;
    public $dataBaseModel;
    public function __construct()
    {
        $this->credentialsModel = new CredentialsModel();
        $this->dataBaseModel    = new DatabaseModel();
    }
    public function init()
    {
        $result = $this->credentialsModel->getLogin();
        
        if ($result == "LOGIN_OK") {
            $user = $_REQUEST['mUser'];
            include 'view/home.php';
        } else if ($result == "REGISTER") {
            include 'view/register.php';
        } else {
            include 'view/login.php';
        }
    }
}
?>