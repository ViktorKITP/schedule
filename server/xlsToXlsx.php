<?php
/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 18.02.2016
 * Time: 15:30
 */
include_once 'Classes/PHPExcel.php';
function xlsToXslx($file_name_input,$file_name_output)
{
 try {
    $objPHPexcel = PHPExcel_IOFactory::load($file_name_input);
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPexcel);
    $objWriter->setOffice2003Compatibility(true);
    $objWriter->save($file_name_output);
     return true;
 } catch (Exception $e) {
     return false;
 }
}
?>