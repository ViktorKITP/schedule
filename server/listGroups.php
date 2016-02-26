<?php

/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 17.02.2016
 * Time: 12:38
 */
class listGroup
{
    private $arr;

private    function shema()
    {
        $this->arr = array(
            1 => array(
                1 => '',
                2 => '',
                3 => '',
                4 => ''

            ),
            2 => array(
                1 => '',
                2 => '',
                3 => '',
                4 => ''

            ),
            3 => array(
                1 => '',
                2 => '',
                3 => '',
                4 => ''

            ),
            4 => array(
                1 => '',
                2 => '',
                3 => '',
                4 => ''

            ),
            5 => array(
                1 => '',
                2 => '',
                3 => '',
                4 => ''

            ),
            6 => array(
                1 => '',
                2 => '',
                3 => '',
                4 => ''

            )

        );

    }

private    function getYear()
    {
        $year1 = substr((string)getdate()["year"], -2);
        return $year1;
    }


    function createListGroups()
    {
        $year1 = $this->getYear();
        /*!!!!!!!!!!!!!!!!!!!!ПРИДУМАТЬ С ДАТАМИ А ПОКА ЗАГЛУШКА*/
        $year1 = (string)((integer)$year1 - 1);
        /*!!!!!!!!!!!!!*/
        $this->shema();

        for ($i = 1; $i <= 6; $i++) {

            switch ($i) {
                case 1:
                    $this->arr[$i][1] = 'ИСТ-' . $year1 . '1';
                    $this->arr[$i][2] = 'ИСТ-' . $year1 . '2';
                    $this->arr[$i][3] = 'ИВТ-' . $year1 . '1';
                    $this->arr[$i][4] = 'ИВТ-' . $year1 . '2';
                    break;
                case 2:
                    $year2 = (string)((integer)$year1 - 1);
                    $this->arr[$i][1] = 'ИСТ-' . $year2 . '1';
                    $this->arr[$i][2] = 'ИСТ-' . $year2 . '2';
                    $this->arr[$i][3] = 'ИВТ-' . $year2 . '1';
                    $this->arr[$i][4] = 'ИВТ-' . $year2 . '2';
                    break;
                case 3:
                    $year2 = (string)((integer)$year1 - 2);
                    $this->arr[$i][1] = 'АМ-' . $year2 . '1';
                    $this->arr[$i][2] = 'ИТ-' . $year2 . '1';
                    break;
                case 4:
                    $year2 = (string)((integer)$year1 - 3);
                    $this->arr[$i][1] = 'АМ-' . $year2 . '1';
                    $this->arr[$i][2] = 'ИТ-' . $year2 . '1';
                    break;
                case 5:
                    $this->arr[$i][1] = 'АМм-' . $year1 . '1';
                    $arr[$i][2] = 'ИСм-' . $year1 . '1';
                    break;
                case 6:
                    $year2 = (string)((integer)$year1 - 1);
                    $this->arr[$i][1] = 'АМм-' . $year2 . '1';
                    $this->arr[$i][2] = 'ИCм-' . $year2 . '1';
                    break;
            }
        }

        $returnArr=$this->arr;
        return $returnArr;
    }


    function listGroupToDB()
    {

    }
}

