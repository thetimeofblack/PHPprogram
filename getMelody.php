<?php
/**
 * Created by PhpStorm.
 * User: 11914
 * Date: 2019/1/6
 * Time: 0:02
 */
        $userid = $_POST["userid"];
        $dbobject = new DBConnection();
        $melodylist = $dbobject->getUserMelody($userid);
        $responsestring = json_encode($melodylist);
        echo $responsestring ;
?>