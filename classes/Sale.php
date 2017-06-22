<?php

/////////////////////
/// Created Date    : June 9, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : Sale.php
/// Description     :
///             It allows the application to add, get, and delete sale data.
/////////////////////

class Sale{
    private $_db,
            $_data;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function create($fields = array()){
        if(!$this->_db->insert('sale', $fields)){
            throw new Exception('There was a problem creating an sale');
        }
    }

    public function getSale($where = array()){
        $data = $this->_db->get('sale', $where);
        $this->_data = $data->results();
    }

    public function findSale($where = array()){
        $data = $this->_db->get('sale', $where);
        if($data->count()) {
            $this->_data = $data->first();

            return true;
        }
        return false;
    }

//    public function offSale(){
//        $this->_data = $this->_data->get('sale', null);
//    }

    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }

    public function delete($id = null){
        if($id){
            $this->_db->delete('sale', array('sale_id', '=', $id));
        }
    }

    public function data(){
        return $this->_data;
    }
}