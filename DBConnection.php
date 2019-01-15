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
            $userid = $this->db->insert_id;
            return $userid;
        }
        return "";
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
            $description = "hello";
            $notelist = $score->getNoteList();
            $timelist = $score->getTimeList();
            $notesize = count($notelist);
            if ($this->db) {
                $sql = "insert into userscore(userid,scorename, scoredescription) values('" . $userid ."','".$name."','".$description."')";
                $result = $this->db->query($sql);

                $scoreid = $this->db->insert_id;
                for ($i = 0; $i < $notesize; $i++) {
                    $note = $notelist[$i];
                    $time = $timelist[$i];
                    $sql2 = "insert into score (chord,length,scoreid) values('".$note."','".$time."','".$scoreid."')";
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
                        //echo $melodyid;
                        $melody = $this->getMelodyElement($melodyid);
                        $melody->setName($row["melodyname"]);
                        $melody->setDescription($row["melodydescription"]);
                        //echo $melody->getChordList();
                        $melody = (array)$melody;

                        $melodyjson = json_encode($melody);
                        //echo $melodyjson ;
                        $melodylist[$i++]=$melodyjson;
                    }
                }

                //var_dump($melodylist);
                return $melodylist;
        }
    }

    private function getMelodyElement($melodyid){

        $melody = new Melody();
        $chordlist = Array();
        $lengthlist = Array();
        if($this->db){
            $sql = "select * from melody where melodyid ='".$melodyid. "'";
            $result = $this->db->query($sql);
            if ($result->num_rows > 0) {
                $i = 0 ;                  // output data of each row
                while($row = $result->fetch_assoc()) {
                   $chordlist[$i] = $row['note'];
                   $lengthlist[$i] = $row['length'];
                   $i = $i+1;
                }
                $melody->setChordList(json_encode($chordlist));
                $melody->setLengthList(json_encode($lengthlist));
            } else {
                //echo "0 results";
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
                    $score = $this->getScoreElement($scoreid);
                    $score->setName($row["scorename"]);
                    $score->setDescription($row["scoredescription"]);
                    $score = $this->object_to_Array($score);
                    //var_dump( $score);

                    $scorelist[$i++]=json_encode($score);
                }
            }

        }
        return $scorelist;

    }

    private function getScoreElement($scoreid){
        $score = new Score();
        $notelist = Array();
        $timelist = Array();
        if($this->db){
            $sql = "select * from score where scoreid ='".$scoreid. "'";
            $result = $this->db->query($sql);
            if ($result->num_rows > 0) {
                $i = 0 ;                  // output data of each row
                while($row = $result->fetch_assoc()) {
                    $notelist[$i] = $row['chord'];
                    $timelist[$i] = $row['length'];
                    $i = $i+1;
                }
                $score->setNoteList(json_encode($notelist));
                $score->setTimeList(json_encode($timelist));
            } else {
                //echo "0 results";
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

            if($userpassword == $dbuserpassword){
                return true;
            }else{
                return false ;
            }

        }
    }

    private function object_to_Array($object){
        $object = (array)$object;
        foreach ($object as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $object[$k] = (array)object_to_array($v);
            }
        }
        return $object ;

    }



    public function closeDataBase(){
        $this->db->close() ;
    }

    public function getUser($userid){

    }

    private function awake(){

    }

}


?>