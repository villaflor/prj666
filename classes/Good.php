<?php

/////////////////////
/// Created Date    : June 16, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : Good.php
/// Description     :
///             It allows the application to get, and update good table.
/////////////////////

class Good{
    private $_db,
            $_data;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function getGood($field = array()){
        $data = $this->_db->get('good', $field);
        $this->_data = $data->results();
    }

    public function find($id = null){
        if($id){
            $data = $this->_db->get('good', array('good_id', '=', $id));

            if($data->count()){
                $this->_data = $data->first();

                return true;
            }
        }

        return false;
    }

    public function setGood($fields = array(), $good_id = null){
        if($good_id) {
            if (!$this->_db->update('good', $good_id, $fields)) {
                throw new Exception('There was a problem updating.');
            }
        }
    }

    public function setOnSale($fields = array(), $category_id = null){
        if($category_id) {
            if (!$this->_db->updateMulti('good', 'category_id = '. $category_id, $fields)) {
                throw new Exception('There was a problem updating.');
            }
        }
    }

    public function unsetOnSale($fields = array(), $sale_id = null){
        if($sale_id) {
            if (!$this->_db->updateMulti('good', 'sale_id = '. $sale_id, $fields)) {
                throw new Exception('There was a problem updating.');
            }
        }
    }

    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }

    public function data(){
        return $this->_data;
    }
}