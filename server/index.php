<?php
/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 12.02.2016
 * Time: 18:18
 */


define("FILE_TEMP","FITKB_TEMP.xls");
define("FILE","FITKB.xls");
define("FILExlsx","FITKB.xlsx");
define("URLXLS","http://www.vorstu.ru/files/materials/5797/%D4%C8%D2%CA%C1%20%F0%E0%F1%EF%E8%F1%E0%ED%E8%E5%20%E2%E5%F1%ED%E0%202016%20-%20%EE%EA%EE%ED%F7%E0%F2%E5%EB%FC%ED%FB%E9%20%E2%E0%F0%E8%E0%ED%F2.xls");


require_once ("./loaderXLS.php");
require_once ("./Errors/FileLoadError.php");
require_once ("parserXLS.php");
require_once ("workDB.php");
require_once ("appConfig.php");


/*if (xlsToXslx(FILE,FILExlsx)){


} else {
    return false;
}*/

//parserXLS("05featuredemo.xlsx",'1.xlsx');
//ВЫВЕСТИ ОШИБКУ


$parser=new parser(new workDB($db_host,$user_name,$password,$db_name));
$parser->parserXLS(FILE);


//$loader=new loaderXLS();
/*try{
    if ($loader->checkXLS(FILE_TEMP,FILE,URLXLS)){
        echo "обновился";
        $parser=new parser("df");
        $parser->parserXLS(FILE);
        // parserXLS(FILE,'csv.csv');
    } else {
        echo "не обновился"."</br>";
        $parser=new parser(new workDB($db_host,$user_name,$password,$db_name));
        $parser->parserXLS(FILE);
        //вывод сообщения что все плохо
    };
}catch(FileLoadError $e){
    $parser=new parser(new workDB($db_host,$user_name,$password,$db_name));
    $parser->parserXLS(FILE);
    echo "Ошибка загрузки файла";
}
catch(Exception $e){
   echo $e;
}*/





