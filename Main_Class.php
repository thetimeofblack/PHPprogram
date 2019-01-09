<?php
/**
 * Created by PhpStorm.
 * User: 11914
 * Date: 2019/1/1
 * Time: 13:50
 */
class Score {

    private $Name = "" ;
    private $description;
    private $notelist;
    private $timelist;
    public function setName($name){
        $this->Name = $name;
}
    public function getName(){
        return $this->Name ;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getDescription($description){
        return $this->description ;
    }

    public function setNoteList($notelist){
        $this->notelist = $notelist ;

    }
    public function getNoteList(){
        return $this->notelist;

    }

    public function setTimeList($timelist){
        $this->timelist  = $timelist;

    }

    public function getTimeList(){
        return $this->timelist;
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

class Melody {

    private $Userid ;
    private $LengthList = array() ;
    private $ChordList  = array() ;
    private $name;
    private $description ;
    public function getUserid(){
        return $this->Userid;
    }

    public function getLengthList(){
        return $this->LengthList;
    }

    public function getChordList(){
        return $this->ChordList ;
    }

    public function setLengthList($List){
        $this->LengthList = $List ;
    }

    public function setChordList($List){
        $this->ChordList = $List ;
    }

    public function setDescription($description){
            $this->description = $description ;
    }

    public function getDescription(){
            return $this->description ;
    }

    public function setName($name){
            $this->name = $name;
    }

    public function getName(){
            return $this->name;

    }
}




?>