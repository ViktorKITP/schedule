<?php
/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 13.02.2016
 * Time: 1:51
 */
class workDB {

 public $DBH = null;
    function __construct($db_host,$user_name,$password,$db_name)
    {
        $this->connectDB($db_host,$user_name,$password,$db_name);
    }

    function connectDB($db_host,$user_name,$password,$db_name){
    //установить связь с БД
        try {
            # MySQL через PDO_MYSQL
            $this->DBH = new PDO("mysql:host=$db_host;dbname=$db_name", $user_name, $password);

        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    function saveSchedule($arr){
    //сохранить в БД расписание

    }
    function saveCourse($arr){

    }
    function saveGroup($kurs){
        $STH =$this->DBH->prepare("INSERT INTO Курс (name) VALUES ($kurs)");
        $STH->execute();
    }
    function getSchedule($group){
        //получить из БД расписание

    }

    function getKurs(){

    }

    function getGroup($kurs){

    }


}