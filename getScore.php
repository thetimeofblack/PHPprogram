<?php
/**
 * Created by PhpStorm.
 * User: 11914
 * Date: 2019/1/5
 * Time: 23:34
 */

$userid = $_POST["userid"];
$dbobject = new DBConnection();
$scorelist = $dbobject->getUserScore($userid);
$responsestring = json_encode($scorelist);
echo $responsestring ;
?>