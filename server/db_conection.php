<?php
/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 13.02.2016
 * Time: 1:51
 */


require_once "appConfig.php";
function db_connection($arr,$db_host,$db_name,$user_name, $password){


try {
    # MySQL через PDO_MYSQL
    $DBH = new PDO("mysql:host=$db_host;dbname=$db_name", $user_name, $password);
}
catch(PDOException $e) {
    echo $e->getMessage();
}

    for  ($i=0;$i<=count($arr);$i++){
        $STH = $DBH->prepare("UPDATE Курс SET name='$arr[$i].1' WHERE 'id'='$i'");
        $STH->execute();
      /*  foreach($ar as $t){

        }
    */}
/*
# набор данных, которые мы будем вставлять
$data = array('Cathy', '9 Dark and Twisty Road', 'Cardiff');

$STH = $DBH->prepare("UPDATE 'Група' SET name=$arr[$i] WHERE  'name'=$ LIMIT 1;");
$STH->execute($data);



# назначаем переменные каждому placeholder, с индексами от 1 до 3
$STH->bindParam(1, $name);
$STH->bindParam(2, $addr);
$STH->bindParam(3, $city);

# вставляем одну строку
$name = "Daniel"
$addr = "1 Wicked Way";
$city = "Arlington Heights";
$STH->execute();


$STH = $DBH->prepare("INSERT INTO folks ( first_name ) values ( 'Cathy' )");
$STH->execute();
*/

//Закрываем соединение
$DBH = null;

/*
mysql_connect($db_host,$user_name,$password) or die("<p>hui tebe</p>");
echo "<p>oke</p>";
mysql_select_db($db_name) or die ("<p>hui tebe2  -".mysql.error()."</p>");
echo "<p>mqyql</p>";*/
}

