<?php
/**
 * Created by PhpStorm.
 * User: 11914
 * Date: 2019/1/5
 * Time: 23:34
 */
include "Main_Class.php" ;
include "DBConnection.php";
function validateInput(){
    return true ;
}
if(validateInput()) {
        $DBobject = new DBConnection();
        $melody = new Melody();
        $userid = "";
        $DBobject->saveUserMelody($userid , $melody);
        $DBobject->closeDataBase();

        echo "<h2> save the Score and Melody successful</h2> "  ;

}
?>