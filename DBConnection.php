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


    public function saveUserMelody($userid, $melody)
    {
        if ($this->db) {
            $notelist = $melody->getChordList();
            $timelist = $melody->getLengthList();
            $melodyname = $melody->getName();
            $melodyDescription = $melody->getDescription();
            $notesize = count($notelist);
            $timesize = count($timelist);
            if ($this->db) {
                $sql = "insert into usermelody(userid) values('" . $userid . "')";
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
                $sql = "insert into usermelody(userid,name, description) values('" . $userid ."','".$name."','".$description."')";
                $result = $this->db->query($sql);
                echo "The Insert Result is " . $result."<br/>";
                $melodyid = mysqli_insert_id();
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
        if($this->db) {
            $sql = "select * from usermelody where userid = '".$userid."'";
            $result = $this->db->query($sql);
            $rows= $result->num_rows;
            $melodylist = array();
            while($rows){
                $rows = $rows - 1;
                $melody = new Melody();
            }

        }
        return $melodylist;
    }

    public function checkUser($userpassword){
        if($this->db){
            $sql = "select * from user where username ='".$userpassword."'";

        }
    }

    public function closeDataBase(){
        $this->db->close() ;
    }

    private function awake(){

    }

}


?>