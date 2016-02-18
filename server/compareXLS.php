<?php
/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 15.02.2016
 * Time: 14:09
 */

function compareXLS($f_t,$f){
    if (hash_file('md5', $f_t)==hash_file('md5', $f)){
        return true;
    } else {
        return false;
    };
}


?>