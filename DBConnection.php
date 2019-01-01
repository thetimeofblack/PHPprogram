<?php
/**
 * Created by PhpStorm.
 * User: 11914
 * Date: 2019/1/1
 * Time: 13:52
 */
class DBConnection{
    private $User;
    private $Chord;
    private $db ;

    public function __construct()
    {
        $db = new mysqli("localhost" ,"root","heyining", "music");

    }

    public function saveUser(){
    }

    public function saveUserChord(){
    }

    public function saveScore($score){

    }

    public function saveMelody($melody){

    }

    public function validateUser(){
    }

    public function sleep(){
    }

    private function awake(){

    }

}


?>