<?php
/**
 * Created by PhpStorm.
 * User: Leito
 * Date: 04.04.2015
 * Time: 16:53
 */

class Tools {
    public static function factory($type){
        if(include_once'scripts/'.$type.'.php'){
            return new $type;
        }else{
            throw new Exception('Script not found.');
        }
    }
    public function connect($host,$login,$password,$database){
        if(isset($password)){
            $link = mysql_connect($host,$login,$password) or die(mysql_error());
            mysql_select_db($database) or die(mysql_error());
        }else{
            $link = mysql_connect($host,$login) or die(mysql_error());
            mysql_select_db($database) or die(mysql_error());
        }
        return $link;
    }
    public function check_user_login($name){
        if(preg_match('/^[a-z0-9_-]{3,16}$/i',$name)){
            return true;
        }else{
            return false;
        }
    }
    public function check_user_password($password){
        if(preg_match('/^[a-z0-9_-]{6,18}$/i',$password)){
            return true;
        }else{
            return false;
        }
    }

}