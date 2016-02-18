<?php

/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 15.02.2016
 * Time: 13:48
 *     $target_url = "http://www.vorstu.ru/files/materials/5797/%D4%C8%D2%CA%C1%20%F0%E0%F1%EF%E8%F1%E0%ED%E8%E5%20%E2%E5%F1%ED%E0%202016%20-%20%EE%EA%EE%ED%F7%E0%F2%E5%EB%FC%ED%FB%E9%20%E2%E0%F0%E8%E0%ED%F2.xls";
$userAgent = 'Googlebot/2.1 (http://www.googlebot.com/bot.html)';
$ch = curl_init($target_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
$output = curl_exec($ch);
$fh = fopen("FITKB_TEMP.xls", 'w');
fwrite($fh, $output);
fclose($fh);
//создаем hash
echo hash_file('md5', 'FITKB_TEMP.xls');
}
 */

class chunkReadFilter implements PHPExcel_Reader_IReadFilter
{
    private $_startRow = 0;
    private $_endRow = 0;
    /**  Set the list of rows that we want to read  */
    public function setRows($startRow, $chunkSize) {
        $this->_startRow    = $startRow;
        $this->_endRow      = $startRow + $chunkSize;
    }
    public function readCell($column, $row, $worksheetName = '') {
        //  Only read the heading row, and the rows that are configured in $this->_startRow and $this->_endRow
        if (($row == 1) || ($row >= $this->_startRow && $row < $this->_endRow)) {
            return true;
        }
        return false;
    }
}

$file =  'somefile.xls';
set_time_limit(1800);
ini_set('memory_liit', '128M');
/*	some vars	*/
$chunkSize = 2000;		//размер считываемых строк за раз
$startRow = 2;			//начинаем читать со строки 2, в PHPExcel первая строка имеет индекс 1, и как правило это строка заголовков
$exit = false;			//флаг выхода
$empty_value = 0;		//счетчик пустых знаений
/*	some vars	*/
if (!file_exists($file)) {
    exit();
}
require_once 'Classes/PHPExcel.php';

$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$objReader->setReadDataOnly(true);

$chunkFilter = new chunkReadFilter();
$objReader->setReadFilter($chunkFilter);
//внешний цикл, пока файл не кончится
while ( !$exit )
{
    $chunkFilter->setRows($startRow,$chunkSize); 	//устанавливаем знаечние фильтра
    $objPHPExcel = $objReader->load($file);		//открываем файл
    $objPHPExcel->setActiveSheetIndex(0);		//устанавливаем индекс активной страницы
    $objWorksheet = $objPHPExcel->getActiveSheet();	//делаем активной нужную страницу
    for ($i = $startRow; $i < $startRow + $chunkSize; $i++) 	//внутренний цикл по строкам
    {
        $value = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(0, $i)->getValue()));		//получаем первое знаение в строке
        if ( empty($value) )		//проверяем значение на пустоту
            $empty_value++;
        if ($empty_value == 3)		//после трех пустых значений, завершаем обработку файла, думая, что это конец
        {
            $exit = true;
            continue;
        }
        /*Манипуляции с данными каким Вам угодно способом, в PHPExcel их превеликое множество*/
    }
    $objPHPExcel->disconnectWorksheets(); 				//чистим
    unset($objPHPExcel); 						//память
    $startRow += $chunkSize;					//переходим на следующий шаг цикла, увеличивая строку, с которой будем читать файл
}
?>