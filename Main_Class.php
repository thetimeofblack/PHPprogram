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

class Score {

    private $Userid ;
    private $LengthList = array() ;
    private $ChordList  = array() ;
    private $scoreid ;

    public function getUserid(){
        return $this->Userid;
    }

    public function getLength(){
        return $this->LengthList;
    }

    public function getChord(){
        return $this->ChordList ;
    }

    public function setLengthList($List){
        $this->LengthList = $List ;
    }

    public function setChordList($List){
        $this->ChordList = $List ;
    }

}


class Melody {
    private  $userid ;
    private  $notelist  ;
    private  $timelist ;
    public function getUserID(){
        return $this->userid ;
    }

    public function getNoteList(){
        return $this->notelist ;
    }

    public function getTimeList(){
        return $this->timelist;
    }

    public function setNoteList($list){
        $this->notelist = $list;
    }

    public function setTimeList($list){
        $this->timelist = $list;
    }

}
?>