<?php

/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 13.02.2016
 * Time: 1:17
 */
include 'Classes/PHPExcel.php';

function parserXLS($file_name_input,$file_name_output){
   // include 'Classes/PHPExcel/IOFactory.php';
    $inputFileType = 'Excel2007';
  //  $file_path='05featuredemo.xlsx';
  //  $inputFileType = PHPExcel_IOFactory::identify( $file_path);
/*    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objReader->setReadDataOnly(true);*/
   // $objReader = PHPExcel_IOFactory::load($file_name_input);



/*    $r = PHPExcel_CachedObjectStorageFactory::initialize(PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp);
    if (!$r) {
        die('Unable to set cell cacheing');
    }*/



  $objPHPExcel1=PHPExcel_IOFactory::load($file_name_input);
  //  $objPHPExcel2=PHPExcel_IOFactory::createWriter($file_name_output);

//$objPHPexcel1=PHPExcel_Reader_Excel2007::

 //   ->
//$objPHPExcel->setR
  /*
$inputFileType = 'Excel2007';
$inputFileName = 'testBook.xlsx';

$r = PHPExcel_CachedObjectStorageFactory::initialize(PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp);
if (!$r) {
    die('Unable to set cell cacheing');
}



*/

    //устанавливаем активную страницу
  //  $page = $objPHPExcel->setActiveSheetIndex(0);
    $workSheet1=$objPHPExcel1->setActiveSheetIndex(2);
   // $workSheet2=$objPHPExcel2->setActiveSheetIndex(0);

    //забираем активную страницу
    $sheet1=$objPHPExcel1->getActiveSheet();
 //   $sheet2=$objPHPExcel2->getActiveSheet();
    //получаем итератор строк
    //$rowIterator1=$sheet1->getRowIterator();



        $highestColumn      = $workSheet1->getHighestColumn();
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    echo $highestColumnIndex;
  //  $sheet1->removeColumn('A',1);
    //$sheet1->re

   // $objPHPexcel = PHPExcel_IOFactory::load($file_name_input);

  //  $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel1);
   // $objWriter->setOffice2003Compatibility(true);
  //  $objWriter->save($file_name_output);

     // $objPHPExcel2=new PHPExcel();
    //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel1);
   //$objPHPExcel2->save($file_name_output);
   /* $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel1, 'Excel2007');
    $objWriter->save($file_name_output);*/


    //проходимся по строкам
   /* foreach($rowIterator1 as $row){
        //поучаем итератор ячеек
        $cellIterator=$row->getCellIterator();
        //проходимся по всем ячейкам
        foreach($cellIterator as $cell){

           $temp_value_cell= $cell->getFormattedValue();

            echo  $temp_value_cell;
            if ($temp_value_cell=="день") {


            }



        }
    }
*/

/*
    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    var_dump($sheetData);*/

    /*$objReader = new PHPExcel_Reader_Excel5();
    $objReader->setReadDataOnly(true);
    try {
        /** Load $inputFileName to a PHPExcel Object  **/
        /*$objPHPExcel = $objReader->load($file_name_input);
    } catch(PHPExcel_Reader_Exception $e) {
        die('Error loading file: '.$e->getMessage());
    }*/
    /*
    $objPHPexcel = PHPExcel_IOFactory::load($file_name_input);
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPexcel);
        $objWriter->setOffice2003Compatibility(true);
        $objWriter->save("05featuredemo.xlsx");

    $objWorksheet = $objPHPexcel->getActiveSheet();
    $objWorksheet->getCell('A1')->setValue('John');
    $objWorksheet->getCell('A2')->setValue('Smith');




  //4  $writer = PHPExcel_IOFactory::createWriter($file_name_input, 'CSV');
 //   $writer = new PHPExcel_Writer_CSV($objPHPExcel);
 //   $writer-> save($file_name_output);
    //$writer->save()
/*
$worksheetData = $objReader->listWorksheetInfo($file_name_input);
    echo '<pre>';
print_r($worksheetData);
    echo '</pre>';
echo '<h3>Worksheet Information</h3>';
echo '<ol>';
foreach ($worksheetData as $worksheet) {
    echo '<li>', $worksheet['worksheetName'], '<br />';
    echo 'Rows: ', $worksheet['totalRows'],
    ' Columns: ', $worksheet['totalColumns'], '<br />';
    echo 'Cell Range: A1:',
    $worksheet['lastColumnLetter'], $worksheet['totalRows'];
    echo '</li>';
}
echo '</ol>';
*/
}



?>