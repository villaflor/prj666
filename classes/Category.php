<?php

/////////////////////
/// Created Date    : June 16, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : Category.php
/// Description     :
///             It allows the application to get category data.
/////////////////////

class Category{
    private $_db,
            $_data;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function getCategory($user_id = null){
        if ($user_id) {
            $data = $this->_db->get('category', array('client_id', '=', $user_id));
            $this->_data = $data->results();
        }
    }

    public function data(){
        return $this->_data;
    }

    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }

}