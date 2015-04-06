<?php
/**
 * Created by PhpStorm.
 * User: Viktor Blovytskyi
 * Date: 03.04.2015
 * Time: 1:12
 *
 * Pattern Data Gateway
 * Methods:
 *      find_users_banner($user_id);
 *      update_date($banner_id,$user_id,$date_of_start,$date_of_end);
 *      update_status($banner_id,$user_id,$status);
 *      insert($user_id,$banner_name,$link,$status,$width,$height,$date_of_start,$date_of_end);
 *      update($banner_id,$user_id,$banner_name,$link,$status,$width,$height,$date_of_start,$date_of_end);
 *      find_by_name($name,$user_id);
 */

class BannerGateway {
    function __construct(){
        $tools = new Tools();
        $tools->connect('localhost','user','','banadmin');
    }

    /*
     * find_users_banner($user_id)
     * This function fetches from the database.
     * Inputs:
     *      $user_id = int;
     */
    function find_users_banner($user_id){
        $result = mysql_query("SELECT * FROM `banners` WHERE user_id = $user_id");
        return $result;
    }

    /*
     * update_date($banner_id,$user_id,$date_of_start,$date_of_end);
     * This function updates the data in the database.
     * Inputs:
     */
    function update_date($banner_id,$user_id,$date_of_start,$date_of_end){
        $result = mysql_query("UPDATE `banners` SET `dateofstart`= '$date_of_start',`dateofend` = '$date_of_end' WHERE `banner_id` =  '$banner_id' AND `user_id` = '$user_id'")
        or die(mysql_error());
    }

    /*
     * update_status($banner_id,$user_id,$status);
     * This function updates the data in the database.
     * Inputs:
     */
    function update_status($banner_id,$user_id,$status){
        $result = mysql_query("UPDATE `banners` SET `status`= '$status'WHERE `banner_id` =  '$banner_id' AND `user_id` = '$user_id'")
        or die(mysql_error());
    }

    /*
     * insert($user_id,$banner_name,$link,$status,$width,$height,$date_of_start,$date_of_end);
     * This function updates the data in the database.
     * Inputs:
     */
    function insert($user_id,$banner_name,$link,$status,$width,$height,$date_of_start,$date_of_end){
        $resutl = mysql_query("INSERT INTO `banners` (`user_id`, `name`, `link`, `status`, `width`, `height`, `dateofstart`, `dateofend`)
          VALUES ('$user_id', '$banner_name', '$link', '$status', '$width', '$height', '$date_of_start', '$date_of_end')") or die(mysql_error());

    }

    /*
     * update($banner_id,$user_id,$banner_name,$link,$status,$width,$height,$date_of_start,$date_of_end);
     * This function updates the data in the database.
     * Inputs:
     */
    function update($banner_id,$user_id,$banner_name,$link,$status,$width,$height,$date_of_start,$date_of_end){
        $result = mysql_query("UPDATE `banners` SET `name` = '$banner_name',`link`='$link',`status`= '$status',`width`='$width',`height`='$height',`dateofstart`='$date_of_start',`dateofend`='$date_of_end'
        WHERE `banner_id` =  '$banner_id' AND `user_id` = '$user_id'") or die(mysql_error());
    }

    /*
     * find_by_name($name,$user_id);
     * This function fetches from the database.
     * Inputs:
     */
    function find_by_name($name,$user_id){
        $result = mysql_query("SELECT banner_id FROM banners WHERE `name` = '$name' AND `user_id` = '$user_id'") or die(mysql_error());
        return mysql_num_rows($result);
    }

}

