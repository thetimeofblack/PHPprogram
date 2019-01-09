<?php
/**
 * Created by PhpStorm.
 * User: 11914
 * Date: 2019/1/5
 * Time: 23:34
 */

include "DBConnection.php";
function validateInput(){
    return true ;
}
if(validateInput()) {

        $melody = new Melody();
        $score = new Score();
        $userid = "";
        var_dump($_POST) ;
        $chordlist = $_POST["chordlist"];
        $timelist = $_POST["timelist"];
        $notelist = $_POST["notelist"];
        $lengthlist = $_POST["lengthlist"];
        $chordlist = json_decode($chordlist);
        $count = count($chordlist);
        for($i=0;$i<$count;$i++){
            echo $chordlist[$i]."</br>";
        }
        $DBobject = new DBConnection();
        $DBobject->saveUserMelody($userid , $melody);
        $DBobject->closeDataBase();

        echo "<h2> save the Score and Melody successful</h2> "  ;

}
?>