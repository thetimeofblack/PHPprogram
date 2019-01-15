<?php
/**
 * Created by PhpStorm.
 * User: 11914
 * Date: 2019/1/10
 * Time: 11:14
 */
include "DBConnection.php";
    $sendArray = $_REQUEST["sendarray"];
    $sendArray  = json_decode($sendArray);
    $sendArray = (array) $sendArray;
    $username =  $sendArray["username"];
    $userpassword = $sendArray["userpassword"];
    $user= new User();
    $user->setUserName($username);
    $user->setUserPassword($userpassword);
    $dbobject = new DBConnection();
    $returnArray = array();
    $returnArray["check"]= $dbobject->checkUser($user);
    echo json_encode($returnArray);
    $dbobject->closeDataBase() ;
?>

<script>


</script>
