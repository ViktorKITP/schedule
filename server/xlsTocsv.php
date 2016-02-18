<?php
/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 17.02.2016
 * Time: 10:09
 */
include 'Classes/PHPExcel.php';
function xlsToCsv ($file_xls_input,$file_name_csv_output){
    $objReader = new PHPExcel_Reader_Excel5();
    try {
        /** Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel = $objReader->load($file_xls_input);
        return true;
    } catch(PHPExcel_Reader_Exception $e) {
        die('Error loading file: '.$e->getMessage());

    }
    $writer = new PHPExcel_Writer_CSV($objPHPExcel);
    $writer-> save($file_name_csv_output);
}
?>