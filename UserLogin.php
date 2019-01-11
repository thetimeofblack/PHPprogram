<?php
/**
 * Created by PhpStorm.
 * User: 11914
 * Date: 2019/1/10
 * Time: 11:14
 */

    $username =  $_REQUEST["username"];
    $userpassword = $_REQUEST["userpassword"];
    $user= new User();
    $user->setUserName($username);
    $user->setUserPassword($userpassword);
    $dbobject = new DBConnection();
    $dbobject->checkUser($user);


?>