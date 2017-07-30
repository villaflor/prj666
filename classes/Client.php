
<?php

/////////////////////
/// Created Date    : July 30, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : Client.php
/// Description     :
///             It allows the admin page to get, and update client table.
/////////////////////

class Client{
    private $_db,
            $_data;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function getClient($field = array()){
        $data = $this->_db->get('client', $field);
        $this->_data = $data->results();
    }

    public function setClient($fields = array(), $client_id = null){
        if($client_id) {
            if (!$this->_db->update('client', $client_id, $fields)) {
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