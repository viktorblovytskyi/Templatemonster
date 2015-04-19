<?php
/**
 * Created by PhpStorm.
 * User: Leito
 * Date: 28.03.2015
 * Time: 0:32
 *
 * Class UserGateway:
 *
 * Pattern Data Gateway
 * Methods:
 *      updateSessionId($session_id,$user_id);
 *      findUserByLoginAndPassword($login, $password);
 *      findUserById($user_id);
 */

class UserGateway{

    function __construct(){
        $tools = new Tools();
        $tools->connect('localhost','user','','banadmin');
    }

    /*
     * updateSessionId($session_id,$user_id);
     * This function updates unique number of session in the database;
     * Inputs:
     *      $session_id - int;
     *      $user_id - int;
     * Outputs:
     *      Void function.
     */
    function updateSessionId($session_id,$user_id){
        mysql_query("UPDATE `users` SET session_id='".$session_id."' WHERE user_id='".$user_id."';")
        or die(mysql_error());
    }

    /*
     * findUserByLoginAndPassword($login, $password);
     * This function finds user's data in the database.
     * Inputs:
     *      $login - String;
     *      $password - String;
     * Output:
     *      Array with result;
     */
    function findUserByLoginAndPassword($login, $password){
        $result = mysql_query("SELECT * FROM  `users` WHERE login =  '$login' AND PASSWORD =  '$password'")
        or die(mysql_error());
        return mysql_fetch_array($result,1);
    }

    /*
     * findUserById($user_id);
     * This function find session's id in database by the user's id.
     * Inputs:
     *      $user_id - int;
     * Outputs:
     *
     */
    function findUserById($user_id){
        $result = mysql_query("SELECT * FROM `users` WHERE user_id = '$user_id';") or die(mysql_error());
        if($result == false) return false;
        return true;
    }


}