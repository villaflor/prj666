<?php

/////////////////////
/// Created Date    : June 4, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : DB.php
/// Description     :
///             This is a database wrapper. Work with PDO PHP data objects to connect to a MYSQL database.
/////////////////////

class DB{
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_result,
            $_count = 0;

    private function __construct(){
        try{
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'),
                Config::get('mysql/username'),
                Config::get('mysql/password'));

            //echo 'Connected to database<br />';
        } catch (PDOException $e){
            die($e->getMessage());
        }
    }

    /// This function will allow the application to connect to database once.
    /// If the connection was already instantiated, it returns the current connection.
    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }

        return self::$_instance;
    }

    // This function prepare query and execute it, and it sets error to true if any.
    // format: $user = DB::getInstance()->query("SELECT username FROM client WHERE username = ? OR username = ?",
    //          array('Olivander', 'billy'));
    public function query($sql, $params = array()){
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;
            //echo 'Success query<br />';
            if(count($params)){
                foreach ($params as $param){
                    $this->_query->bindValue($x, $param);
                    //echo 'Param' . $x . ' is successfully add<br />';
                    $x++;
                }
            }

            if($this->_query->execute()){
                //echo 'Executed successfully<br />';
                $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                echo 'Unsuccessful execution<br />';
                $this->_error = true;
            }

        }

        return $this;
    }

    private function action($action, $table, $where = array()){
        if(count($where) === 3){
            $operators = array('=', '>', '<', '>=', '<=');
            $field      = $where[0];
            $operator   = $where[1];
            $value      = $where[2];

            if(in_array($operator, $operators)){
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql, array($value))->error()){
                    return $this;
                }
            }
        }

        return false;
    }

    /// This function gets record from the database
    /// $user = DB::getInstance()->get('client', array('username', '=', 'Olivander'));
    public function get($table, $where){
        return $this->action('SELECT *', $table, $where);
    }

    /// This function inserts records to the database
    /// format: $user = DB::getInstance()->insert('client',
    /// array(
    /// 'client_name' => 'mark',
    /// 'client_site_title' => 'marks testing site',
    /// 'client_logo' => '/data/default/testing.png',
    /// 'client_information' => 'This is a testing site',
    /// 'client_tax' => 13.0,
    /// 'payment_option_paypal' => 1,
    /// 'payment_option_visa' => 1,
    /// 'payment_option_mastercard' => 1,
    /// 'payment_option_ae' => 0,
    /// 'username' => 'mavillaflor',
    /// 'password' => 'password',
    /// 'client_admin_email' => 'mavillaflor@myseneca.ca'
    /// ));
    public function insert($table, $fields = array()){
        if(count($fields)){
            $keys = array_keys($fields);
            $values = '';
            $x = 1;

            foreach ($fields as $field){
                $values .= '?';

                if($x < count($fields)){
                    $values .= ', ';
                }
                $x++;
            }

            $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

            if(!$this->query($sql, $fields)->error()){
                return true;
            }
        }

        return false;
    }


    /// This function sets data to an existing record
    /// format: $user = DB::getInstance()->update('client', 6,
    /// array(
    /// 'client_name' => 'new owner2',
    /// 'password' => 'newPassword2'
    /// ));
    public function update($table, $id, $fields = array()){
        if(count($fields)){
            $set = '';
            $x = 1;

            foreach ($fields as $col_name => $value){
                $set .= "{$col_name} = ?";
                if($x < count($fields)){
                    $set .= ', ';
                }
                $x++;
            }

            $sql = "UPDATE {$table} SET {$set} WHERE ${table}_id = {$id}";
            if(!$this->query($sql, $fields)->error()){
                return true;
            }
        }
        return false;
    }

    public function updateMulti($table, $where, $fields = array()){
        if(count($fields)){
            $set = '';
            $x = 1;

            foreach ($fields as $col_name => $value){
                $set .= "{$col_name} = ?";
                if($x < count($fields)){
                    $set .= ', ';
                }
                $x++;
            }

            $sql = "UPDATE {$table} SET {$set} WHERE {$where}";
            if(!$this->query($sql, $fields)->error()){
                return true;
            }
        }
        return false;
    }

    public function delete($table, $where){
        return $this->action('DELETE', $table, $where);
    }

    public function results(){
        return $this->_result;
    }

    /// This returns the first result in  the query
    public function first(){
        return $this->results()[0];
    }

    public function count(){
        return $this->_count;
    }

    // This function returns the _error value
    public function error(){
        return $this->_error;
    }
}