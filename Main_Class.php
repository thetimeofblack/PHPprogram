<?php
/**
 * Created by PhpStorm.
 * User: 11914
 * Date: 2019/1/1
 * Time: 13:50
 */
class chord {
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
?>