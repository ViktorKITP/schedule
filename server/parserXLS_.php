<?php

/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 13.02.2016
 * Time: 1:17
 */
//если не загрузился- ну дапустим ошибка загрузки файла- надо сделать чтобы парсил старое или выдавал старое
include_once 'Classes/PHPExcel.php';
require_once('listGroups.php');
require_once('workDB.php');
require_once('filter.php');
require_once('finder.php');

class parser
{
    /** @var workDB */
    public $db = null;
    public $filterGroup = null;
    public $filterDay =null;
    public $arrFindGroup = null;
    public $arrFindTime = null;
    public $arrFindDay = null;
    public $sheet = null;
    public $arrMerge = null;
    public $filterObj = null;
    public $temp = null;


    /**
     * parser constructor.
     * @param $db
     */
    function __construct($db,$f)
    {
        $this->db = $db;
        $this->filterObj=new filter();
        $this->filterGroup =  $this->filterObj->getFilterGroup();
        $this->filterDay =  $this->filterObj->getFilterDay();



        //test
        $t=new finder($f);
      //  $t->testEcho($t->g);


     //   $objPHPExcel = PHPExcel_IOFactory::load($f);



   /*     function getSheets($fileName) {
            try {
                $fileType = PHPExcel_IOFactory::identify($fileName);
                $objReader = PHPExcel_IOFactory::createReader($fileType);
                $objPHPExcel = $objReader->load($fileName);
                $sheets = [];
                foreach ($objPHPExcel->getAllSheets() as $sheet) {
                    $sheets[$sheet->getTitle()] = $sheet->toArray();
                }
                return $sheets;
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }*/
//$this->temp=$objPHPExcel->getAllSheets();
   //     echo '<pre>';
   //     echo $this->temp;
     //   echo '</pre>';

        //$this->filter = $this->createFilter();
        //   echo 'constr';
    }

    /**
     * @param $file_name
     * @throws PHPExcel_Exception
     */
    function parserXLS()
    {



    }

    /**
     * @param $rowIterator
     */
    // public  $i=0;



/*
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
        $tempLastRow = $this->lastRow($sheet, $indexCellDAY);
        //заносим в новую PHPExcel_Worksheet расписанице
        do {

            $value = $sheet->getCell($indexColumn . $indexRow)->getFormattedValue();
            $day = $sheet->getCellByColumnAndRow(0, $indexRow)->getFormattedValue();;
            $time = $sheet->getCellByColumnAndRow(1, $indexRow)->getFormattedValue();;
            echo '$value=' . $value;
            echo "day=$day";
            echo 'time=' . $time;
            print_r($this->db, true);
            $this->db->saveSchedule($day, $time, $value);
            $indexRow++;

        } while ($indexRow !== $tempLastRow);
    }*/
}

