<?php
/**
 * Created by PhpStorm.
 * User: 11914
 * Date: 2019/1/1
 * Time: 13:52
 */
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
            $sql = "Insert into user values ('".$username."','".$userpassword."')";

            $this->db->query($sql);
            echo "Insert successful" ;
            $userid = mysqli_insert_id();
            return $userid;
        }
    }


    public function saveUserMelody($userid, $melody)
    {
        if ($this->db) {
            $notelist = $melody->getNoteList();
            $timelist = $melody->getTimeList();
            $notesize = count($notelist);
            if ($this->db) {
                $sql = "insert into usermelody values('" . $userid . "')";
                $result = $this->db->query($sql);
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

    public function saveUserScore($userid, $score){

    }

    public function getUserMelody($userid){
        if($this->db) {
            $sql = "select * from usermelody where userid = '".$userid."'";
            $result = $this->db->query($sql);

        }

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