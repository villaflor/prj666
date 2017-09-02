<?php

/////////////////////
/// Created Date    : June 6, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : Cookie.php
/// Description     :
///             Allows the application to deal with cookies.
/////////////////////

class Cookie{
    public static function exists($name){
        return (isset($_COOKIE[$name])) ? true : false;
    }

    public static function get($name){
        return $_COOKIE[$name];
    }

    public static function put($name, $value, $expiry){
        if(setcookie($name, $value, time() + $expiry, '/')){
            return true;
        }

        return false;
    }

    public static function delete($name){
        return self::put($name, '', time() - 1);
    }

    public static function addToCart($data = array(), $cookieName = 'Cart'){
        $toBeAdded = array();
        $found = false;
        $counter = 0;
        if(Cookie::exists($cookieName)){
            $cookieData = Cookie::get($cookieName);
            $cookieData = stripslashes($cookieData);
            $toBeAdded = json_decode($cookieData);
            Cookie::delete($cookieName);
        }
            foreach ($toBeAdded as $item => $x){
                if($x->good_id == $data['good_id']) {
                    $toBeAdded[$counter]->quantity += $data['quantity'];
                    $found = true;
                }

                $counter++;
            }

            if(!$found) array_push($toBeAdded, $data);
            $json = json_encode($toBeAdded);
            Cookie::put($cookieName, $json, 3600);
    }

    public static function deleteItem($itemId = null, $cookieName = 'Cart'){
        if($itemId) {
            $toBeAdded = array();
            $counter = 0;
            if (Cookie::exists($cookieName)) {
                $cookieData = Cookie::get($cookieName);
                $cookieData = stripslashes($cookieData);
                $toBeAdded = json_decode($cookieData);
                Cookie::delete($cookieName);
            }
            foreach ($toBeAdded as $item => $x) {
                if ($x->good_id == $itemId) {
                    if (count($toBeAdded) > 1) {
                        array_splice($toBeAdded, $counter, 1);
                        //unset($toBeAdded[$counter]);
                        $json = json_encode($toBeAdded);
                        Cookie::put($cookieName, $json, 3600);
                        break;
                    } else {
                        $toBeAdded = null;
                        Cookie::delete($cookieName);
                        break;
                    }

                }

                $counter++;
            }
        }
    }

    public static function changeQtyCart($data = array(), $cookieName = 'Cart'){
        $toBeAdded = array();
        $found = false;
        $counter = 0;
        if(Cookie::exists($cookieName)){
            $cookieData = Cookie::get($cookieName);
            $cookieData = stripslashes($cookieData);
            $toBeAdded = json_decode($cookieData);
            Cookie::delete($cookieName);
        }
        foreach ($toBeAdded as $item => $x){
            if($x->good_id == $data['good_id']) {
                $qty = (int)$data['quantity'];
                if($qty < 1){
                    $qty = 1;
                }
                $toBeAdded[$counter]->quantity = $qty;
                $found = true;
            }
            $counter++;
        }

        if(!$found) exit;
        $json = json_encode($toBeAdded);
        Cookie::put($cookieName, $json, 3600);
    }

    public static function getCart($cookieName = 'Cart'){
        $data = null;
        if(Cookie::exists($cookieName)){
            $cookieData = Cookie::get($cookieName);
            $cookieData = stripslashes($cookieData);
            $data = json_decode($cookieData);
        }

        return $data;
    }
}
