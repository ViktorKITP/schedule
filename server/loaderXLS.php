<?php
/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 13.02.2016
 * Time: 1:44

 */
//ПРИ ОТСУТСТВИИ ПОДКЛЮЧЕНИЯ ВСЕ РАВНО СКАЧИВАЕТ ФАЙЛ С РАЗМЕРОМ 0 И ВСЕ ЛЕТИТ
require_once "./Errors/FileLoadError.php";

class loaderXLS {

    /**
     * @param $target_url
     * @param $target_name
     * @throws Exception
     */
    private function loadXLS($target_url, $target_name){
        try {
            $userAgent = 'Googlebot/2.1 (http://www.googlebot.com/bot.html)';

            $ch = curl_init($target_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);


            if( ! $result = curl_exec($ch))
            {
                throw new FileLoadError();
            }
            curl_close($ch);

            $fh = fopen($target_name, 'w');
            fwrite($fh, $result);
            fclose($fh);

        } catch (Exception $e) {
            throw $e;
        }
    }

    function checkXLS($file_name_temp,$file_name,$url_xls){
        try {
            $this->loadXLS($url_xls, $file_name_temp);

            if($this->compareXLS($file_name_temp,$file_name)) {//файл скачался, оказался дубликатом
                //echo "Файл не обновился";
                //удалем временный файл
                unlink($file_name_temp);
                return false;

            } else  {//файл обновился
                //удалять ли старый так быстро???
                //    $file_name_temp_temp="temp.xls";
                //   copy($file_name,$file_name_temp_temp);
                unlink($file_name);
                rename($file_name_temp,$file_name);
                return true;


            }
        } catch (Exception $e){
            throw $e;
        }
    }

    private   function compareXLS($f_t, $f){
        //убедиться что существуют 2 файла
        if (hash_file('md5', $f_t)==hash_file('md5', $f)){
            return true;
        } else {
            return false;
        };
    }


}


?>