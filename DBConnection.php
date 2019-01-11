<?php
/**
 * Created by PhpStorm.
 * User: 11914
 * Date: 2019/1/1
 * Time: 13:52
 */

include "Main_Class.php";





class DBConnection{

    private $db ;


    public function __construct()
    {
        $this->db = new mysqli("localhost" ,"root","heyining", "music");
    }


    public function saveUser($user){
        if($this->db){
            $username = $user->getUserName() ;
            $userpassword = $user->getUserPassword();
            $sql = "Insert into user(username, userpassword) values ('".$username."','".$userpassword."')";
            $this->db->query($sql);
            echo "Insert successful" ;
            $userid = mysqli_insert_id();
            return $userid;
        }
    }



    public function saveUserMelody($userid, $melody){
        if ($this->db) {
            $notelist = $melody->getChordList();
            $timelist = $melody->getLengthList();
            $melodyname = $melody->getName();
            $melodyDescription = $melody->getDescription();
            $notesize = count($notelist);
            $timesize = count($timelist);
            if ($this->db) {
                $sql = "insert into usermelody(userid,melodyname,melodydescription) values('" . $userid . "','".$melodyname."','".$melodyDescription."')";
                $result = $this->db->query($sql);

                $melodyid = $this->db->insert_id;
               // echo "This is melodyid " . $melodyid;
                for ($i = 0; $i < $notesize; $i++) {
                    $note = $notelist[$i];
                    $time = $timelist[$i];
                    $sql2 = "insert into melody (note,length,melodyid) values('".$note."','".$time."','".$melodyid."')";
                    $this->db->query($sql2);
                }
            }
        }
    }


    public function saveUserScore($userid, $score){
        if ($this->db) {
            $name = $score->getName();
            $description = $score->getDescription();
            $notelist = $score->getNoteList();
            $timelist = $score->getTimeList();
            $notesize = count($notelist);
            if ($this->db) {
                $sql = "insert into userscore(userid,scorename, scoredescription) values('" . $userid ."','".$name."','".$description."')";
                $result = $this->db->query($sql);

                $melodyid = $this->db->insert_id;
                for ($i = 0; $i < $notesize; $i++) {
                    $note = $notelist[$i];
                    $time = $timelist[$i];
                    $sql2 = "insert into melody (note,length,melodyid) values('".$note."','".$time."','".$melodyid."')";
                    $this->db->query($sql2);

                }
            }
        }
    }



    public function getUserMelody($userid){

        $melodylist = Array();
        if($this->db) {
            $sql = "select * from usermelody where userid = '".$userid."'";
                $result = $this->db->query($sql);
                $i=0;
                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                         $melodyid = $row["id"];
                         $melody = getMelodyElement($melodyid);
                         $melody->setName($row["melodyname"]);
                         $melody->setDescription($row["melodydescription"]);
                         $melodylist[$i++]=$melody;
                    }
                }
                return $melodylist;
        }
    }

    public function getMelodyElement($melodyid){

        $melody = new Melody();
        $chordlist = Array();
        $lengthlist = Array();
        if($this->db){
            $sql = "select * from melody where melodyid ='".$melodyid. "'";
            $result = $this->db->query($sql);
            if ($result->num_rows > 0) {
                $i = 0 ;                  // output data of each row
                while($row = $result->fetch_assoc()) {
                   $chordlist[$i++] = $row['note'];
                   $lengthlist[$i++] = $row['length'];
                }
                $melody->setChordList($chordlist);
                $melody->setLengthList($lengthlist);
            } else {
                echo "0 results";
            }
        }
        return $melody;
    }

    public function getUserScore($userid){

        $scorelist = Array();
        if($this->db) {
            $sql = "select * from userscore where userid = '".$userid."'";
            $result = $this->db->query($sql);
            $i=0;
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $scoreid = $row["id"];
                    $score = getScoreElement($scoreid);
                    $score->setName($row["scorename"]);
                    $score->setDescription($row["scoredescription"]);
                    $scorelist[$i++]=$score;
                }
            }

        }
        return $scorelist;

    }

    public function getScoreElement($scoreid){
        $score = new Score();
        $notelist = Array();
        $timelist = Array();
        if($this->db){
            $sql = "select * from score where scoreid ='".$scoreid. "'";
            $result = $this->db->query($sql);
            if ($result->num_rows > 0) {
                $i = 0 ;                  // output data of each row
                while($row = $result->fetch_assoc()) {
                    $notelist[$i++] = $row['chord'];
                    $timelist[$i++] = $row['length'];
                }
                $score->setNoteList($notelist);
                $score->setTimeList($timelist);
            } else {
                echo "0 results";
            }
        }
        return $score;
    }


    public function checkUser($user){

        if($this->db){
            $username = $user->getUserName();
            $userpassword = $user->getUserPassword();

            $sql = "select * from user where username ='".$username."'";
            $result = $this->db->query($sql);
            $dbusername = "";
            $dbuserpassword = "";
            if ($result->num_rows > 0) {
                $i = 0 ;                  // output data of each row
                while($row = $result->fetch_assoc()) {
                        $dbusername = $row["username"];
                        $dbuserpassword = $row["userpassword"];
                }

            } else {
                return false;
            }

            if($username == $dbusername){

                return true;
            }else {
               return false ;
            }

        }
    }





    public function closeDataBase(){
        $this->db->close() ;
    }


    private function awake(){

    }

}


?>