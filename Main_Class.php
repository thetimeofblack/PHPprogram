<?php
/**
 * Created by PhpStorm.
 * User: 11914
 * Date: 2019/1/1
 * Time: 13:50
 */
class Chord {
    private $Content = "";
    private $Name = "" ;
    public function getContent(){
        return $this->Name;
}
    public function getName(){
        return $this->Content ;
    }

    public function setName($Name){
        $this->Name = $Name ;
    }

    public function setContent($Content){
        $this->Content = $Content ;
    }
}

class User {
    private $UserName;
    private $UserPassword;
    public function getUserName() {
        return $this->UserName ;
    }
    public function getUserPassword(){
        return $this->UserPassword ;

    }

    public function setUserName($Name){
       $this->UserName = $Name;
    }

    public function setUserPassword($Password){
        $this->UserPassword = $Password ;
    }


}

?>