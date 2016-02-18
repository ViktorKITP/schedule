<?php
/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 17.02.2016
 * Time: 14:46
 */
include 'listGroups.php';
function listGroupToBD ($arr){
db_connection(createListGroups());
}


?>

