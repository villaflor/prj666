<?php

/////////////////////
/// Created Date    : August 24, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : Order.php
/// Description     :
///
/////////////////////

class Order{
    private $_db,
            $_data;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }

    public function delete($id = null){
        if($id){
            $this->_db->delete('invoice', array('invoice_id', '=', $id));
        }
    }

    public function data(){
        return $this->_data;
    }
}
