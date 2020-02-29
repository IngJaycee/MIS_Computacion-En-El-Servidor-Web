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
        if(isset($_SESSION)) var_dump($_SESSION);
        if(isset($_REQUEST)) var_dump ($_REQUEST);
        
        if (!isset($_SESSION['user'])){
            $this->login();
        }else{
            $this->home($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteUser']) && $_POST['deleteUser']);
        }
    }
    
    private function login(){
        $result = $this->credentialsModel->getLogin();
        echo $result ;

        if ($result == "LOGIN_OK") {
            $this->home();
        } else if ($result == "REGISTER") {
            $this->getRegisterView($result);
        } else {
            $this->getLoginView($result);
        }
    }

    private function home($isDelete = false){
        if (!$isDelete){
            $this->getHomeView();
        }else{
            $this->credentialsModel->removeUser();
            $this->getLoginView();
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

    private function getHomeView($result = ""){
        $user = $_SESSION["user"];
        include 'view/home.php';
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