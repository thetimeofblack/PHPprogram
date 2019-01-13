<?php
/**
 * Created by PhpStorm.
 * User: 11914
 * Date: 2019/1/11
 * Time: 23:23
 */
    include "DBConnection.php";
    //var_dump($_REQUEST);

    $userid = $_REQUEST["userid"];
    $dbobject = new DBConnection();
    $melodylist= $dbobject->getUserMelody($userid);
    $scorelist = $dbobject->getUserScore($userid);

    $sendArray["melodylist"] = json_encode($melodylist);
    //echo $sendArray["melodylist"];
    $sendArray["scorelist"] = json_encode($scorelist) ;
    //echo $sendArray["scorelist"];
    $sendArray = json_encode($sendArray);
    echo $sendArray ;
    $dbobject->closeDataBase();

    ?>