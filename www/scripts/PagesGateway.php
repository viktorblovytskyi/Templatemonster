<?php
/**
 * Created by PhpStorm.
 * User: Leito
 * Date: 18.04.2015
 * Time: 2:28
 *
 * Class PagesGateway:
 *
 * Pattern Data Gateway
 * Methods:
 *      select($banner_id)
 *      insert($banner_id, $link)
 *      update_visits($id)
 *      delete($id)
 */

class PagesGateway {
    function __construct(){
        $tools = new Tools();
        $tools->connect('localhost','user','','banadmin');
    }

    /*
     * select($banner_id)
     * This function gets all information from tablet 'pages'
     * Table:
     *      Pages
     * Inputs:
     *      $banner_id int
     * Outputs:
     *      $result
     */
    function select($banner_id){
        $result = mysql_query("SELECT * FROM `pages` WHERE banner_id = $banner_id" )or die(mysql_error());
        return $result;
    }

    /*
     * insert($banner_id, $link)
     * This function insert data in database.
     * Table:
     *      Pages
     * Inputs:
     *      $banner_id = int
     *      $Link = String
     */
    function insert($banner_id,$link){
        $result = mysql_query("INSERT INTO `pages`( `banner_id`, `link`) VALUES ('".$banner_id."', '".$link."' )")or die(mysql_error());
    }

    /*
     * This function update visits in database.
     * Table:
     *      Pages
     * Inputs:
     *      $id = int
     */
    function update_visits($id){
        $result = mysql_query("SELECT visits FROM `pages` WHERE  id = $id") or die(mysql_error());
        $visits = mysql_fetch_array($result);
        $updated_visits = $visits['visits']++;
        $result = mysql_query("UPDATE `pages` SET visits = ".$updated_visits." WHERE id = $id") or die(mysql_error());
    }

    /*
     * This function delete page from database.
     * Table:
     *      Page
     * Inputs:
     *      $id = int
     */
    function delete($id){
        $result = mysql_query("DELETE FROM `pages` WHERE id = $id") or die(mysql_error());
    }

}