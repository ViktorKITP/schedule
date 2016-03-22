<?php
/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 13.02.2016
 * Time: 1:51
 */
include_once 'finder.php';
class workDB {

    public $arr_schedule;
 public $DBH = null;
    function __construct($db_host,$user_name,$password,$db_name,/*  test*/$fileName)
    {
        $this->connectDB($db_host,$user_name,$password,$db_name);

       $finder = new finder($fileName);
    //    $this->arr_schedule=$finder->arr_schedule;
       $this->saveSchedule( '1','2','3');


        $finder->testEcho($this->arr_schedule);


    }

    function connectDB($db_host,$user_name,$password,$db_name){
    //установить связь с БД
        try {
            # MySQL через PDO_MYSQL
            $this->DBH = new PDO("mysql:host=$db_host;dbname=$db_name", $user_name, $password);
            $this->DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "подключено";
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    function saveSchedule($day1,$time1,$value){
    //сохранить в БД расписание
        $this->deleteTable();

        try {

            foreach ($this->arr_schedule as $key=>$item) {

            $STH = $this->DBH->prepare("INSERT INTO schedule (`DAY`,`TIME`,`VALUE`) VALUES (:day1,:time1,:value1)");


            //$STH->bindParam(':day1', $day1,PDO::PARAM_STR, 1);
            $STH->bindParam(':day1', $item['day'],PDO::PARAM_STR, 10);
            $STH->bindParam(':time1', $item['time'],PDO::PARAM_STR, 5);
            $STH->bindParam(':value1', $item['value'],PDO::PARAM_STR, 50);

            $STH->execute();
            }
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
            throw $e;
        }
    }
    function deleteTable (){
        $STH = $this->DBH->prepare("TRUNCATE TABLE `schedule`");
        $STH->execute();
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
        $STH =$this->DBH->prepare("select (name) from Course");
        while($row = mysql_fetch_assoc($STH)){               
            $GRP[] = $row;
        }
        return json_encode($GRP); 
    }

    function getGroup($kurs){
        $STH =$this->DBH->prepare("select (name) from Group where Course = "+$kurs); 
        while($row = mysql_fetch_assoc($STH)){ 
            $COR[] = $row; 
        }
        return json_encode($COR); 
    }


}