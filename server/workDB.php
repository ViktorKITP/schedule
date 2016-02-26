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
            $this->DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    function saveSchedule($day,$time,$value){
    //сохранить в БД расписание
        try {
            $STH =$this->DBH->prepare("INSERT INTO schedule ('DAY','TIME','VALUE') VALUES (:day,:time,:value)");
//            $STH =$this->DBH->prepare("INSERT INTO course (name) VALUES ('xxx')");

            $STH->bindParam(':name', $day);
            $STH->bindParam(':time', $time);
            $STH->bindParam(':value', $value);

            $value = '1';
            $day='2';
            $time='3';

            $STH->execute();
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
            throw $e;
        }
    }
    function saveCourse($arr){

    }
    function saveGroup($kurs){
       /* $STH =$this->DBH->prepare("INSERT INTO Schedule (name) VALUES (:day,:time,:value)");
        $STH->b
        $STH->execute();



      //  $stmt = $dbh->prepare("INSERT INTO REGISTRY (name, value) VALUES (:name, :value)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':value', $value);

// вставим одну строку
        $name = 'one';
        $value = 1;
        $stmt->execute();*/

// теперь другую строку с другими значениями
        $name = 'two';
        $value = 2;
//        $stmt->execute();



    }
    function getSchedule($group){
        //получить из БД расписание

    }

    function getKurs(){

    }

    function getGroup($kurs){

    }


}