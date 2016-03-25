<?php

/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 03.03.2016
 * Time: 16:41
 */
class listTime
{





   public    function shema()
    {
        $arr = array(
                1 => '8:00',
                2 => '9:45',
                3 => '11:30',
                4 => '13:30',
                5 => '15:15',
                6 => '17:00',
                7 => '18:45',
                8 => '20:30'

        );
        return $arr;

    }



}


$r=new listTime();
/*
echo "<pre>";
echo print_r($r->shema());
echo "</pre>";*/

$t=$r->shema();

$reg='/^[0-9]:[0-9][0-9]|[0-9][0-9]:[0-9][0-9]/';
//$reg='/^[0-9]:[0-9][0-9]/';
foreach ($t as $i) {
  //  echo $i."</br>";
    if(preg_match( $reg,$i)) echo $i."</br>";
}
