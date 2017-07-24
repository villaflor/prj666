<?php

/////////////////////
/// Created Date    : July 23, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : Admin.php
/// Description     :
///             It allows the admin to login, logout, view details, and update the application.
/////////////////////


class Admin{
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedIn;

    public function __construct($user = null){
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');
        if(!$user){
            if(Session::exists($this->_sessionName)){
                $user = Session::get($this->_sessionName);

                if($this->find($user)){
                    $this->_isLoggedIn = true;
                } else{
                    // process logut
                }
            }
        } else{
            $this->find($user);
        }

    }

    public function update($fields = array(), $id = null){
        if(!$id && $this->isLoggedIn()){
            $id = $this->data()->client_id;
        }

        if(!$this->_db->update('admin', $id, $fields)){
            throw new Exception('There was a problem updating.');
        }
    }

    public function create($fields = array()){
        if(!$this->_db->insert('admin', $fields)){
            throw new Exception('There was a problem creating an account');
        }
    }

    public function find($user = null){
        if($user){
            $field = (is_numeric($user)) ? 'admin_id' : 'admin_username';
            $data = $this->_db->get('admin', array($field, '=', $user));

            if($data->count()){
                $this->_data = $data->first();

                return true;
            }
        }

        return false;
    }

    public function emailExist($email = null){
        if($email){

            $data = $this->_db->get('admin', array('admin_email', '=', $email));

            if($data->count()){
                $this->_data = $data->first();

                return true;
            }
        }

        return false;
    }

    public function login($username = null, $password = null, $remember = false){
        $user = $this->find($username);

        if(!$username && !$password && $this->exists()){
            Session::put($this->_sessionName, $this->data()->admin_id);
        } else {
            if ($user) {
                if ($this->data()->admin_password === Hash::make($password, $this->data()->salt)) {
                    Session::put($this->_sessionName, $this->data()->admin_id);

                    if ($remember) {
                        $hash = Hash::unique();
                        $hashCheck = $this->_db->get('admin_session', array('admin_id', '=', $this->data()->client_id));

                        if (!$hashCheck->count()) {
                            $this->_db->insert('admin_session', array(
                                'admin_id' => $this->data()->admin_id,
                                'hash' => $hash
                            ));
                        } else {
                            $hash = $hashCheck->first()->hash;
                        }

                        Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                    }

                    return true;
                }
            }
        }

        return false;
    }

    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }

    public function logout(){
        $this->_db->delete('admin_session', array('admin_id', '=', $this->data()->admin_id));

        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
    }

    public function data(){
        return $this->_data;
    }

    public function isLoggedIn(){
        return $this->_isLoggedIn;
    }

    public function deleteUser(){
        $this->_db->delete('admin', array('admin_id', '=', $this->data()->admin_id));
    }
}