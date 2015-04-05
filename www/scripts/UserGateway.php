<?php
/**
 * Created by PhpStorm.
 * User: Leito
 * Date: 28.03.2015
 * Time: 0:32
 */

class UserGateway{

    public function updateSessionId($session_id,$user_id){
        $tools = new Tools();
        $tools->connect('localhost','user','','banadmin');
        mysql_select_db('banadmin') or die(mysql_error());
        mysql_query("UPDATE `users` SET session_id='".$session_id."' WHERE user_id='".$user_id."';")
        or die(mysql_error());
    }

    public function findUserByLoginAndName($login, $password){
        $tools = new Tools();
        $tools->connect('localhost','user','','banadmin');
        $result = mysql_query("SELECT * FROM  `users` WHERE login =  '$login' AND PASSWORD =  '$password'")
        or die(mysql_error());
        return mysql_fetch_array($result,1);
    }

    public function findUserById($user_id){
        $tools = new Tools();
        $tools->connect('localhost','user','','banadmin');
        $result = mysql_query("SELECT session_id FROM `users` WHERE user_id = '$user_id';") or die(mysql_error());
        return mysql_result($result,0);
    }


}