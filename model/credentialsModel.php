<?php
class CredentialsModel{
    public function __construct()
    {
        # code...
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
        $$user = strtolower($$user);
        $validCredentials = $this->readValidCredentials();
        if (empty($user) || empty($pass) || !array_key_exists($user, $validCredentials)){
            return FALSE;
        }

        if ($validCredentials[$user] == sha1($pass)){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    private function saveNewUser($newUser = "", $newPass = "")
    {
        $newUser = strtolower($newUser);
        $validCredentials = $this->readValidCredentials();
        if (empty($newUser) || empty($newPass) || array_key_exists($newUser, $validCredentials)){
            return "REGISTER_USED_ERROR";
        }
        $validCredentials[$newUser] = sha1($newPass);
        $result="";
        foreach ($validCredentials as $user => $pass) {
            $separador = ($result == "") ? "" : "||" ;
            $result .= $separador . $user . "|" . $pass;
        }
        $filePath = "file/secret.txt";
        file_put_contents($filePath, $result);
        return "REGISTER_OK";
    }
}
?>