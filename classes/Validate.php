<?php

/////////////////////
/// Created Date    : June 4, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : Validate.php
/// Description     :
///             It allows the application to validate and check the user's inputs
/// Changes / Updates:
/// June 6, 2017 - In check function, added matchesTo reader
/////////////////////

class Validate{
    private $_passed = false,
            $_errors = array(),
            $_db = null;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = array()){
        foreach ($items as $item => $rules){
            foreach ($rules as $rule => $rule_value){
                $value = trim($source[$item]);
                $item = escape($item);

                if($rule === 'required' && empty($value)){
                    $this->addError("{$rules['name']} is required");
                } else if(!empty($value)){
                    switch ($rule){
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError("new password must be a minimum of {$rule_value} characters.");
                            }
                            break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("new password must be a maximum of {$rule_value} characters.");
                            }
                            break;
                        case 'matches':
                            if($value != $source[$rule_value]){
                                $this->addError("{$rules['matchesTo']} must match {$rules['name']}.");
                            }
                            break;
                        case 'notMatches':
                            if($value == $source[$rule_value]){
                                $this->addError("{$rules['notMatchesTo']} must not match {$rules['name']}.");
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if($check->count()){
                                $this->addError("{$rules['name']} already exist.");
                            }
                            break;
                        case 'futureDate':
                            // if($date_now = date("Y-m-d") >= $value && $rule_value){
                            //     $this->addError("{$rules['name']} must be a future date");
                            // }
                            break;
                    }
                }
            }
        }

        if(empty($this->_errors)){
            $this->_passed = true;
        }

        return $this;
    }

    public function addError($error){
        $this->_errors[] = $error;
    }

    public function errors(){
        return $this->_errors;
    }

    public function passed(){
        return $this->_passed;
    }
}
