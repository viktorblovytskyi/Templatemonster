<?php
/**
 * Created by PhpStorm.
 * User: Viktor Blovytskyi
 * Date: 04.04.2015
 * Time: 16:53
 *
 * Class Tools:
 *
 * Methods:
 *      factory($type);
 *      connect($host,$login,$password,$database);
 *      check_user_login($name);
 *      check_user_password($password);
 *      check_banner_name($data);
 *      write_in_file($banner_name,$content);
 *      reading_from_file($banner_name); *
 */

class Tools {

    /*
     * factory($type)
     * Pattern implementation "factory".
     * Inputs:
     *      $type - String; Name of class;
     */
    public static function factory($type){
        if(include_once'scripts/'.$type.'.php'){//**************
            return new $type;
        }else{
            throw new Exception('Script not found.');
        }
    }

    /*
     * connect($host,$login,$password,$database)
     * This function opens a connection to the MySQL server.
     * Inputs:
     *      $host - String cannot be null;
     *      $login - String cannot be null;
     *      $password - String. If no password is required, you can use empty quotes;
     * Output:
     *      $link - Returns a MySQL connection.
     */
    function connect($host,$login,$password,$database){
        if(isset($password)){
            $link = mysql_connect($host,$login,$password) or die(mysql_error());
            mysql_select_db($database) or die(mysql_error());
        }else{
            $link = mysql_connect($host,$login) or die(mysql_error());
            mysql_select_db($database) or die(mysql_error());
        }
        return $link;
    }

    /*
     * check_user_login($name)
     * This function verifies the user's password.
     * Inputs:
     *      $name - String;
     * Outputs:
     *      True - if password is correct;
     *      False - if password is incorrect;
     */
    function check_user_login($name){
        if(preg_match('/^[a-z0-9_-]{3,16}$/i',$name)){
            return true;
        }else{
            return false;
        }
    }

    /*
     * check_user_password($password)
     * This function verifies the user's password.
     * Inputs:
     *      $password - String;
     * Outputs:
     *      True - if password is correct;
     *      False - if password is incorrect;
     */
    function check_user_password($password){
        if(preg_match('/^[a-z0-9_-]{6,18}$/i',$password)){
            return true;
        }else{
            return false;
        }
    }

    /*
     * check_banner($data)
     * This function verifies banner name.
     * Input:
     *      $data = Array
     * Output:
     *      Boolean result
     *
     */
    function check_banner($data){
        //ispravit' regularku dlya date dobavit' sravnenie datu
        if(preg_match('/^[a-zA-Z0-9_-]{6,32}$/i',$data['banner_name']) && preg_match('/^[0-9]{1,32}$/i',$data['height']) && preg_match('/^[0-9]{1,32}$/i',$data['width']) && preg_match('/\d{4}\-\d{2}\-\d{2}/i',$data['date_of_start']) && preg_match('/\d{4}\-\d{2}\-\d{2}/i',$data['date_of_end']) && preg_match('/\d{4}\-\d{2}\-\d{2}/i',$data['date_of_start'])){
            return true;
        }else{
            return false;
        }
    }





}
