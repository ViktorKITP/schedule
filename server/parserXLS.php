<?php

/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 13.02.2016
 * Time: 1:17
 */
//если не загрузился- ну дапустим ошибка загрузки файла- надо сделать чтобы парсил старое или выдавал старое
include 'Classes/PHPExcel.php';
require_once('listGroups.php');
require_once('workDB.php');

class parser
{
    /** @var workDB */
    public $db = null;
    public $filter = null;

    /**
     * parser constructor.
     * @param $db
     */
    function __construct($db)
    {
        $this->db = $db;
        $this->filter = $this->createFilterGroup();
        //   echo 'constr';
    }

    /**
     * @param $file_name
     * @throws PHPExcel_Exception
     */
    function parserXLS($file_name)
    {

   $objPHPExcel1 = PHPExcel_IOFactory::load($file_name);

        //устанавливаем активную страницу
        //$workSheet1 = $objPHPExcel1->setActiveSheetIndex(0);
        $objPHPExcel1->setActiveSheetIndex(0);

        //забираем активную страницу
        $sheet = $objPHPExcel1->getActiveSheet();

        //проходимся по строкам
        $this->findGroups($sheet);

    }


    function createFilterGroup()
    {
        $lsGr = new listGroup();
        $filter = $lsGr->createListGroups();
        return $filter;
    }


    /**
     * @param $rowIterator
     */
    // public  $i=0;
    function findGroups(PHPExcel_Worksheet $sheet)
    {
        $b = false;
        $indexCellDAY = 0;
        $rowIterator = $sheet->getRowIterator();
        foreach ($rowIterator as $row) {
            //поучаем итератор ячеек
            $cellIterator = $row->getCellIterator();
            //проходимся по всем ячейкам
            foreach ($cellIterator as $cell) {
                //удаляем пробелы вокруг и переводим в верхний регистр
                $cell_value = mb_strtoupper(trim($cell->getFormattedValue()));

                if ($b) {
                    echo $cell_value;
                    if (in_array($cell_value, $this->filter[1])) {

                        $this->saveColumn($cell->getColumn(), $cell->getRow(), $sheet, $indexCellDAY);
                        // $this->db->saveGroup($cell_value);
                        //                    $this->findSchedule($cell);
                    }

                }
                if ($cell_value == "ДЕНЬ") {
                    // echo $cell_value;
                    $b = true;
                    //получаем индекс строки ДЕНЬ
                    $indexCellDAY = $cell->getRow();
                }
            }
            //        echo $this->i++;
            if ($b)
                return;

        }
        // $filter=$this->createFilter();
    }


    function findSchedule($cell)
    {

    }

    function lastRow(PHPExcel_Worksheet $sheet, $indexCellDAY)
    {
        //получаем индекс последней строки в ЛИСТЕ
        $higestRow = $sheet->getHighestRow();
        for ($i = $indexCellDAY; $i <= $higestRow; $i++) {
            $tempRow = $sheet->getCellByColumnAndRow(0, $i)->getFormattedValue();
            if (mb_strtoupper(trim($tempRow)) == "СУББОТА")
                return ++$i;
        }
    }

    function saveColumn($indexColumn, $indexRow, PHPExcel_Worksheet $sheet, $indexCellDAY)
    {
        $tempLastRow=$this->lastRow($sheet, $indexCellDAY);
           //заносим в новую PHPExcel_Worksheet расписанице
        do {

            $value = $sheet->getCell($indexColumn . $indexRow)->getFormattedValue();
            $day=$sheet->getCellByColumnAndRow(0,$indexRow)->getFormattedValue();;
            $time=$sheet->getCellByColumnAndRow(1,$indexRow)->getFormattedValue();;
           echo '$value='.$value;
           echo "day=$day";
           echo 'time='.$time;
            print_r($this->db, true);
            $this->db->saveSchedule($day,$time,$value);
            $indexRow++;

        } while ($indexRow !== $tempLastRow);
    }
}

