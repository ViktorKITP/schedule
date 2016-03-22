<?php

/**
 * Created by IntelliJ IDEA.
 * User: Viktor
 * Date: 09.03.2016
 * Time: 14:39
 */
require_once('listGroups.php');

class filter
{
    private $filterGroup=null;
    private $filterDay=null;
    private $lsGr=null;

    function __construct()
    {
        $this->lsGr = new listGroup();
    }


    function getFilterGroup()
    {

        $this->filterGroup = $this->lsGr->createListGroups();
        return $this->filterGroup;
    }


    function getFilterDay()
    {

        $this->filterDay = $this->lsGr->createListDay();
        return $this->filterDay;
    }


}