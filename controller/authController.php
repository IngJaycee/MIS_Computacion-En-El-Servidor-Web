<?php
require_once('model/credentialsModel.php');
class AuthController
{
    public $credentialsModel;
    public function __construct()
    {
        $this->credentialsModel = new CredentialsModel();
    }
    public function init()
    {
        if(!isset($_SESSION)) session_start();
        
        if (!isset($_SESSION['user'])){
            $this->login();
        }else{
            $isCloseSession = $_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST['closeSession']) || isset($_POST['deleteUser']));

            $this->home($isCloseSession);
        }
    }
    
    private function login(){
        $result = $this->credentialsModel->getLogin();

        if ($result == "LOGIN_OK") {
            $this->home();
        } else if ($result == "REGISTER") {
            $this->getRegisterView($result);
        } else {
            $this->getLoginView($result);
        }
    }

    private function home($isCloseSession = false){
        if ($isCloseSession){
            if (isset($_POST['deleteUser'])){
                $this->credentialsModel->removeUser();
            }
            $this->getLoginView();
        }else{
            $this->isUpdateUser();
            $this->getHomeView();
        }
    }

    private function getLoginView($result = ""){
        $this->resetVariables();
        include 'view/login.php';
    }

    private function getRegisterView($result = ""){
        $this->resetVariables();
        include 'view/register.php';
    }

    private function getHomeView($result = "", $isEditMode = false){
        $user = $_SESSION["user"];
        $isEditMode = $_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['updateUser']);
        include 'view/home.php';
    }

    private function isUpdateUser(){
        $isEditRequest = $_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['reqUpdate']);
        if ($isEditRequest){
            unset($_REQUEST['updateUser']);
            unset($_REQUEST['reqUpdate']);
            $this->credentialsModel->updateUser();
        }
    }

    private function resetVariables() {
        unset($_REQUEST['mUser']);
        unset($_REQUEST['mPass']);
        unset($_REQUEST['user']);
        $_SESSION = array();
        unset( $_SESSION );
        session_destroy();
    }
}
?>