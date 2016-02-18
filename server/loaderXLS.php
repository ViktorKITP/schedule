<?php
/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 13.02.2016
 * Time: 1:44

*/
//ПРИ ОТСУТСТВИИ ПОДКЛЮЧЕНИЯ ВСЕ РАВНО СКАЧИВАЕТ ФАЙЛ С РАЗМЕРОМ 0 И ВСЕ ЛЕТИТ
function loaderXLS($target_url,$target_name){
    //через COPY
/*$file = 'http://www.vorstu.ru/files/materials/5797/%D4%C8%D2%CA%C1%20%F0%E0%F1%EF%E8%F1%E0%ED%E8%E5%20%E2%E5%F1%ED%E0%202016%20-%20%EE%EA%EE%ED%F7%E0%F2%E5%EB%FC%ED%FB%E9%20%E2%E0%F0%E8%E0%ED%F2.xls';
$newfile = 'FITKB.xls';
if (!copy($file, $newfile)) {
    echo "не удалось скопировать $file...\n";
}
*/
    //через х.з.
try {
   // $target_url = "http://www.vorstu.ru/files/materials/5797/%D4%C8%D2%CA%C1%20%F0%E0%F1%EF%E8%F1%E0%ED%E8%E5%20%E2%E5%F1%ED%E0%202016%20-%20%EE%EA%EE%ED%F7%E0%F2%E5%EB%FC%ED%FB%E9%20%E2%E0%F0%E8%E0%ED%F2.xls";
    $userAgent = 'Googlebot/2.1 (http://www.googlebot.com/bot.html)';
    $ch = curl_init($target_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    $output = curl_exec($ch);
    $fh = fopen($target_name, 'w');
    fwrite($fh, $output);
    fclose($fh);
    return true;
    //создаем hash

    } catch (Exception $e) {
        return false;
       }
}


?>