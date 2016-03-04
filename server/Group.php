<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Group
 *
 * @author KIR
 */
class Group {
    //put your code here
    public $name = ''; 
    public $coordinates = array(); 
    
    function getName(){
        return $this->name;
    }
    
    function setName($newName){
        $this->name = $newName;
    }
}
