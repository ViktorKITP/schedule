<?php

/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 09.03.2016
 * Time: 14:37
 */
include_once 'Classes/PHPExcel.php';
include_once 'filter.php';

class finder
{
    public $filterGroup;
    public $arrFindGroup;
    public $arr_temp;
    public $arr_getDay;
    public $arr_getTime;
    public $arr_getGroups;
    public $arr_Work_Sheet;
    public $objPHPExcel;
    public $arr_merged_allCells;
    public $arrFindTime;
    public $filterDay;
    public $arrFindDay;
    public $arr_filter_day;
    public $arr_filter_groups;
    public $arr_schedule;


    public $objPHPExcel1;


//
    /*    function getSheets(PHPExcel $objPhpExcel) {
            try {

                $sheets  = [];
                foreach ($objPhpExcel->getAllSheets() as $sheet) {
                    $sheets[$sheet->getTitle()] = $sheet->toArray();

                   // $this->findGroups($sheet);
                    //$this->findSchedule1($sheet);



                }
                return $sheets;
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }*/

    /**
     * finder constructor.
     * @param $file_name
     */
    function __construct($file_name)
    {
        $filter = new filter();
        $this->arr_filter_day=$filter->getFilterDay();
        $this->arr_filter_groups=$filter->getFilterGroup();
        $y=$filter->getFilterDay();
        $this->objPHPExcel = PHPExcel_IOFactory::load($file_name);
        $this->getAllMergedCells($this->objPHPExcel);
        //забираем все страницы
        $this->arr_Work_Sheet = $this->objPHPExcel->getAllSheets();
        $this->getAllMergedCells($this->objPHPExcel);
        $this->objPHPExcel->setActiveSheetIndex(0);
        $r=$this->objPHPExcel->getActiveSheet();


      //  $this->arr_merged_allCells=$r->getMergeCells();

       // echo "sheet->".$this->objPHPExcel->getSheetCount();
        /*for ($i=0; $i<=9; $i++){

            echo $r->getTitle();
        }*/

        $t=$r->getCell('B17');
       $q= $this->findTime($r);
        $w=$this->findGroups($r,1);
        $this->arr_schedule=$this->findLessonS($r,$q,$w);
        // $this->testEcho($arr);
                 // echo  $this->getDay($this->objPHPExcel, $r, $t,$y);
        //foreach ($this->arr_Work_Sheet as $sheet){

       // $this->testEcho($this->findTime($sheet));
       // }

   //     $this->arrFindTime = null;
     //   $this->arrFindGroup = null;
       // $this->filterDay = $filter->getFilterDay();
  //      $this->filterGroup = $filter->getFilterGroup();
    //    $this->findSchedule($this->arr_Work_Sheet);


        //       echo $this->getValueMergedCell($this->objPHPExcel, 0, $this->arr_merged_allCells,'A',54);
        //  $this->get();
        // $objPHPExcel1->setActiveSheetIndex(0);


        //забираем активную страницу
        //  $sheet = $objPHPExcel1->getActiveSheet();
        //   $this->sheet=$sheet;

        // $this->arrMerge= $sheet->getMergeCells();

        //   echo "<pre>";
        //  echo print_r(   $this->arrMerge);
        //  echo "</pre>";
        //проходимся по строкам
        //   $this->findGroups($sheet);
    }


    function getAllMergedCells(PHPExcel $objPHPExcel)
    {
        $i = 0;
        foreach ($objPHPExcel->getAllSheets() as $sheet) {
            $this->arr_merged_allCells[$i] = $sheet->getMergeCells();
            $i++;
        }
    }

    function getStrToUpper (PHPExcel_Cell $cell){
        $b=false;


        try{
            $b=mb_strtoupper(trim($cell->getFormattedValue()));
        } catch (Exception $e){
            $b=false;

        }

        return $b;
    }

    function findGroups(PHPExcel_Worksheet $sheet, $kurs = 1)
    {
        $arr_temp = null;
        $rowIterator = $sheet->getRowIterator();
        foreach ($rowIterator as $row) {
            //поучаем итератор ячеек
            $cellIterator = $row->getCellIterator();
            //проходимся по всем ячейкам
            foreach ($cellIterator as $cell) {
                //удаляем пробелы вокруг и переводим в верхний регистр

                $cell_value =$this->getStrToUpper($cell);//  mb_strtoupper(trim($cell->getFormattedValue()));
                //заполняем массив с названиями групп

                if (in_array($cell_value, $this->arr_filter_groups[$kurs])) {

                    $arr_temp[] = array(
                        $cell_value => array(

                            "x" => $cell->getColumn(),
                            "y" => $cell->getRow()
                        )
                    );

                    $this->arrFindGroup = $arr_temp;

                }

            }

        }

        //$this->testEcho($arr_temp);

        return $arr_temp;


        // $filter=$this->createFilter();
    }

    /**
     * @param PHPExcel $objPHPExcel
     * @param int $indexSheet
     * @param $arr_merged_allCells
     * @param $col
     * @param $row
     * @return string
     * @throws PHPExcel_Exception
     */

    //возвращает значение обединеной ячейки,
    function getValueMergedCell(PHPExcel $objPHPExcel, $indexSheet = 0, $arr_merged_allCells, $col, $row)
    {
        $temp = null;
        $objPHPExcel->setActiveSheetIndex($indexSheet);
        $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row);

        foreach ($arr_merged_allCells[$indexSheet] as $currMergedRange) {
            if ($cell->isInRange($currMergedRange)) {
                //возвращает массив
                /* Array
                 (
                     [0] => Array
                     (
                         [0] => A25
                         [1] => A36    )  )*/
                $currMergedCellsArray = PHPExcel_Cell::splitRange($currMergedRange);
                $temp = $objPHPExcel->getActiveSheet()->getCell($currMergedCellsArray[0][0])->getFormattedValue();

            }

        }
        return $temp;
    }

    //Находим день по ячейке с ВРЕМЕНЕМ. принадлежность времени и дня
    /**
     * @param PHPExcel $objPHPExcel
     * @param PHPExcel_Worksheet $sheet
     * @param string $col
     * @param int|string $row
     * @param string $day
     * @return bool
     * @throws PHPExcel_Exception
     */

    function getDay(PHPExcel $objPHPExcel, PHPExcel_Worksheet $sheet, PHPExcel_Cell $cell, $arr_filter )
    {
        $g=true;
        $b = false;

        $objPHPExcel->setActiveSheetIndexByName($sheet->getTitle());
        $act_sheet = $objPHPExcel->getActiveSheet();
        $index_sheet=$objPHPExcel->getActiveSheetIndex();
        $row=$cell->getRow();
        $column=$cell->getColumn();
       // $cell_v=$cell->getFormattedValue();
        $columnHiestIndex = PHPExcel_Cell::columnIndexFromString($act_sheet->getHighestColumn($row));
        $rowHiestIndex=$act_sheet->getHighestRow();
        $column = PHPExcel_Cell::columnIndexFromString($column);
        //$this->testEcho($rowHiestIndex);
        $cell_value='';

        for ($i = 0; $i <$column; $i++) {
            $cell_value = $this->getValueMergedCell($objPHPExcel,$index_sheet , $this->arr_merged_allCells, $i, $row);
            //  $this->testEcho($cell_value);
            if ( in_array($cell_value, $arr_filter)) {

              //
                //  $this->testEcho($cell_value);
                $b = true;
            }
            if ($b)
            {   $g=false;
                break;
            }
        }

        if ($g){
            for ($i = $column+1; $i <= $columnHiestIndex; $i++) {
                $cell_value = $this->getValueMergedCell($objPHPExcel, $index_sheet, $this->arr_merged_allCells, $i, $row);
                //  $this->testEcho($cell_value);
                if ( in_array($cell_value, $arr_filter)) {

              //      $this->testEcho($cell_value);
                    $b = true;
                }
                if ($b)
                {   $g=false;
                    break;
                }
            }
        }

        if  ($g){
            for ($i = 0; $i < $row; $i++) {
                $cell_value = $this->getValueMergedCell($objPHPExcel, $index_sheet, $this->arr_merged_allCells, $column, $i);
                //  $this->testEcho($cell_value);
                if ( in_array($cell_value, $arr_filter)) {

               //     $this->testEcho($cell_value);
                    $b = true;
                }
                if ($b)
                {   $g=false;
                    break;
                }
            }
        }
        if ($g){
            for ($i = $row+1; $i <= $rowHiestIndex; $i++) {
                $cell_value = $this->getValueMergedCell($objPHPExcel, $index_sheet, $this->arr_merged_allCells, $column,$i);
                //  $this->testEcho($cell_value);
                if ( in_array($cell_value, $arr_filter)) {

           //         $this->testEcho($cell_value);
                    $b = true;
                }
                if ($b)
                {
                    break;
                }
            }
        }

   /*
        for ($i = 0; $i <= $rowHiestIndex; $i++) {
            $cell_value = $this->getValueMergedCell($objPHPExcel, $index_sheet, $this->arr_merged_allCells, $i, $row);
          //  $this->testEcho($cell_value);
            if ($cell_value == $day) {

                $this->testEcho($cell_value);
                return $b = true;
            }
        }
        $this->testEcho('Тестим B');
        $this->testEcho($b);
        if (!$b) {
            $colHiestIndex = $sheet->getHighestRow($col);
            $this->testEcho($colHiestIndex);
            for ($i = 0; $i <= $colHiestIndex; $i++) {
                $cell_value = $this->getValueMergedCell($objPHPExcel, $index_sheet, $this->arr_merged_allCells, $col, $i);
                if ($cell_value == $day) {
                    $this->testEcho($cell_value);

                }
            }

        }

  */      return $cell_value;
    }

    function getDayTest(PHPExcel $objPHPExcel, PHPExcel_Worksheet $sheet, $col = 'A', $row = 1, $day = 'ПОНЕДЕЛЬНИК')
    {
        $b = false;
        $index_sheet = $objPHPExcel->getActiveSheetIndex();
        $rowHiestIndex = PHPExcel_Cell::columnIndexFromString($sheet->getHighestColumn($row));
        for ($i = 0; $i <= $rowHiestIndex; $i++) {
            $cell_value = $this->getValueMergedCell($objPHPExcel, $index_sheet, $this->arr_merged_allCells, $i, $row);
            if ($cell_value == $day) {
                return $b = true;
            }
        }
        if (!$b) {
            $colHiestIndex = $sheet->getHighestRow($col);
            for ($i = 0; $i <= $colHiestIndex; $i++) {
                $cell_value = $this->getValueMergedCell($objPHPExcel, $index_sheet, $this->arr_merged_allCells, $col, $i);
                if ($cell_value == $day) {
                    return $b = true;
                }
            }

        }

        return $b;
    }




    function findTime(PHPExcel_Worksheet $sheet)
    {
        $arr_temp = null;
        $rowIterator = $sheet->getRowIterator();
        foreach ($rowIterator as $row) {
            //поучаем итератор ячеек
            $cellIterator = $row->getCellIterator();
            //проходимся по всем ячейкам
            foreach ($cellIterator as $cell) {
                //удаляем пробелы вокруг и переводим в верхний регистр

                $cell_value =$this->getStrToUpper($cell);


                //МАСКА
                $reg = '/^[0-9]:[0-9][0-9]|[0-9][0-9]:[0-9][0-9]/';
                //заполняем массив с названиями групп
                if (preg_match($reg, $cell_value)) {
                    $x = $cell->getColumn();
                    $y = $cell->getRow();

                    $arr_temp[]=array(
                        $cell_value=>array(
                            "row" => $y,
                            "column" => $x,
                            "day" => $this->getDay($this->objPHPExcel, $sheet, $cell, $this->arr_filter_day)
                        )
                    );

                    $this->arrFindTime = $arr_temp;
                }
            }
        }
      //  $this->testEcho($arr_temp);
        //echo "<pre>";
        //echo print_r($arr_temp);
        //echo "</pre>";

        return $arr_temp;
    }

    /**
     * @param $test
     */
    function testEcho($test)
    {
        if (gettype($test) == 'array') {

            echo '<pre>';
            print_r($test);
            echo '</pre>';

        } else {
            echo $test . '->' . $test . '</br>';

        }


    }


    function findDay(PHPExcel_Worksheet $sheet)
    {

        $arr_temp = null;
        $rowIterator = $sheet->getRowIterator();
        foreach ($rowIterator as $row) {
            //поучаем итератор ячеек
            $cellIterator = $row->getCellIterator();
            //проходимся по всем ячейкам
            foreach ($cellIterator as $cell) {
                //удаляем пробелы вокруг и переводим в верхний регистр

                $cell_value =$this->getStrToUpper($cell);// mb_strtoupper(trim($cell->getFormattedValue()));

                //заполняем массив с названиями Day
                if (in_array($cell_value, $this->filterDay)) {

                    foreach ($this->arr_merged_allCells as $currMergedRange) {
                        if ($cell->isInRange($currMergedRange)) {
                            //Находим позициию :,и выделяем часть от нее до конца
                            $temp = substr($currMergedRange, strpos($currMergedRange, ':'));

                            echo '$temp->' . $temp . "</br>";

                            $t = null;
                            //
                            for ($i = 0; $i < strlen($temp); $i++) {
                                echo '$i->' . $i . "</br>";

                                if (intval($temp[$i])) {
                                    $t .= $temp[$i];
                                    echo '$t->' . $t . "</br>";

                                }

                            }
                        }
                    }


                    $arr_temp[] = array(
                        "value" => $cell_value,

                        "y" => $cell->getRow(),
                        "x" => $cell->columnIndexFromString($cell->getColumn()),
                        "z" => $cell->getColumn()
                        //,
                        // "time" => $this->findTime($sheet)

                        // "lastx"=>$cell->ra


                    );
                    $this->arrFindDay[] = $arr_temp;
                }
            }
        }

        echo "<pre>";
        echo print_r($arr_temp);
        echo "</pre>";


        return $arr_temp;
    }

    function getCellCoord (){

    }


    function findLessonS(PHPExcel_Worksheet $sheet, $arr_Time, $arr_Group)
    {

        $b = null;
        $arr_temp = null;

        if (isset($arr_Time) && isset($arr_Group)) {

            foreach ($arr_Group as $temp) {
                foreach ($temp as $groupName => $value) {

                    foreach ($arr_Time as $temp1) {
                        foreach ($temp1 as $key_time => $value_time) {

                            $result = $sheet->getCell($value['x'] . $value_time['row'])->getFormattedValue();

                            if ($result == '') {
                            } else {
                                $arr_temp[] = array(
                                    'group' => $groupName,
                                    'time' => $key_time,
                                    'day' => $value_time['day'],
                                    'value' => $result
                                );
                            }
                        }
                    }
                }
            }
        } else {

            //вывод сообщения о том что нет на странице нашего расписания
            $arr_temp = false;
        }

        return $arr_temp;
    }












    function findSchedule($t)
    {
        $i = 1;
        foreach ($t as $sheet) {
          //  $this->findDay($sheet);
            $this->findTime($sheet);
            $this->findGroups($sheet, $i);
            $i++;
        }

        // $this->findSchedule1($this->sheet);
    }

    /*
        function findSchedule1(PHPExcel_Worksheet $sheet)
        {
            $arrSchedule = null;

            $this->arrFindDay = $this->findDay($this->sheet);


            $this->arrFindGroup = $this->findGroups($this->sheet);
            $this->arrFindTime = $this->findTime($this->sheet);


            foreach ($this->arrFindGroup as $value) {

                foreach ($this->arrFindDay as $item) {
                    foreach ($this->arrFindTime as $times) {
                        //  if $times["x"]>=$item["x"] $times.nex
                        echo '$sheet->getCellByColumnAndRow($item[x], $value[y])->' . $sheet->getCellByColumnAndRow($item["x"], $value["y"]) . "</br>";
                    }
                }
            }
        }

    */
}