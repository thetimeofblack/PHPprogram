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
        //var_dump($_POST) ;
        $chordlist = $_POST["chordlist"];
        $timelist = $_POST["timelist"];
        $notelist = $_POST["notelist"];
        $lengthlist = $_POST["lengthlist"];
        $userid = $_POST["userid"];
        $melodyname = $_POST["melodyname"];
        $melodydescription = $_POST["melodydescription"];
        $scorename = $_POST["scorename"];
        $scoredescription = $_POST["scoredescription"];
        $chordlist  = json_decode($chordlist);
        $timelist   = json_decode($timelist);
        $notelist   = json_decode($notelist);
        $lengthlist = json_decode($lengthlist);


        $melody->setChordList($chordlist);
        $melody->setLengthList($lengthlist);
        $melody->setName($melodyname);
        $melody->setDescription($melodydescription);

        $score->setNoteList($notelist);
        $score->setTimeList($timelist);
        $score->setName($scorename);
        $score->setDescription($scoredescription);


        /*
        $count = count($chordlist);
        for($i=0;$i<$count;$i++){
            echo $chordlist[$i]."</br>";
        }
        */
        $DBobject = new DBConnection();
        $DBobject->saveUserMelody($userid   , $melody);
        $DBobject->saveUserScore($userid   ,   $score);

        $DBobject->closeDataBase();

        echo "<h2> save the Score and Melody successful</h2> "  ;

}
?>