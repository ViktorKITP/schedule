<?php
/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 15.02.2016
 * Time: 15:05
 */
//????НУЖНО ЛИ ВЫВОДИТЬ СООБЩЕНИЯ ОБ ОБНОВЛЕНИИ ФАЙЛОВ и если да то куда

// 0- не обновился,ошибка
function up2serverXLS($file_name_temp,$file_name,$url_xls){

    include_once ('compareXLS.php');
    include_once ('loaderXLS.php');
 /*   $file_name_temp="FITKB_TEMP.xls";
    $file_name="FITKB.xls";
    $url_xls="http://www.vorstu.ru/files/materials/5797/%D4%C8%D2%CA%C1%20%F0%E0%F1%EF%E8%F1%E0%ED%E8%E5%20%E2%E5%F1%ED%E0%202016%20-%20%EE%EA%EE%ED%F7%E0%F2%E5%EB%FC%ED%FB%E9%20%E2%E0%F0%E8%E0%ED%F2.xls";
echo $file_name_temp.'</br>';
echo $file_name.'</br>';
echo $url_xls.'</br>';
*/
    $result_download=loaderXLS($url_xls,$file_name_temp);
    echo $result_download."</br>";//1

    if ($result_download==false) {//файл не скачался
        echo "="."< /br>";

        // echo "Файл временно не досутпен";
    } else if(compareXLS($file_name_temp,$file_name)) {//файл скачался, оказался дубликатом

        //echo "Файл не обновился";
        echo "2"."</br>";
        try {//удалем временный файл
            unlink($file_name_temp);
            echo "3"."</br>";
            return false;

        } catch (Exception $e){

            // echo "Не удается переименовать";
        }

    } else  {//файл обновился

        echo "4"."</br>";
        //удаляем файл

        try {//удалять ли старый так быстро???
        //    $file_name_temp_temp="temp.xls";
         //   copy($file_name,$file_name_temp_temp);
            unlink($file_name);
            rename($file_name_temp,$file_name);
            return true;
        } catch (Exception $e){


            // echo "Не удается удалить файл";
        }

    }
}



?>