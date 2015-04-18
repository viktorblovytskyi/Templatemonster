<?php
/**
 * Created by PhpStorm.
 * User: Leito
 * Date: 18.04.2015
 * Time: 2:28
 */

class PagesGateway {
    function __construct(){
        $tools = new Tools();
        $tools->connect('localhost','user','','banadmin');
    }
    function select($banner_id){
        $result = mysql_query("SELECT * FROM `pages` WHERE banner_id = $banner_id" )or die(mysql_error());
        return $result;
    }

    function insert($banner_id,$link){
        $result = mysql_query("INSERT INTO `pages`( `banner_id`, `link`) VALUES ('".$banner_id."', '".$link."' )")or die(mysql_error());
    }

    function update_visits($id){
        $result = mysql_query("SELECT visits FROM `pages` WHERE  id = $id") or die(mysql_error());
        $visits = mysql_fetch_array($result);
        $result = mysql_query("UPDATE `pages` SET visits = ".$visits['visits']++." WHERE id = $id") or die(mysql_error());
    }

    function delete($id){
        $result = mysql_query("DELETE FROM `pages` WHERE id = $id") or die(mysql_error());
    }

}