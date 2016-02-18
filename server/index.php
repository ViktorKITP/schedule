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

include_once 'upToServerXLS.php';
include_once 'parserXLS.php';
include_once 'listGroups.php';
include_once 'xlsToXlsx.php';

/*if (xlsToXslx(FILE,FILExlsx)){


} else {
    return false;
}*/

parserXLS("05featuredemo.xlsx",'1.xlsx');

/*if (up2serverXLS(FILE_TEMP,FILE,URLXLS)){
   echo "обновился";
  // parserXLS(FILE,'csv.csv');
} else {
   echo "не обновился"."</br>";
   /вывод сообщения что все плохо
};
echo '<pre>';
print_r(createListGroups());
echo '</pre>';*/

?>