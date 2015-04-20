<?php
/**
 * Created by PhpStorm.
 * User: Viktor Blovytskyi
 * Date: 03.04.2015
 * Time: 1:12
 *
 * Class BannerGateway:
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
     * Table:
     *      banners
     * Inputs:
     *      $user_id = int;
     */
    function find_users_banner($user_id){
        $result = mysql_query("SELECT * FROM `banners` WHERE user_id = $user_id");
        return $result;
    }

    /*
     * find_users_banner($user_id)
     * This function fetches banner with status true from the database.
     * Table:
     *      banners
     * Inputs:
     *      $user_id = int;
     */
    function find_users_banner_on($user_id){
        $result = mysql_query("SELECT * FROM `banners` WHERE user_id = $user_id AND  status = TRUE");
        return $result;
    }

    /*
     * update_date($banner_id,$user_id,$date_of_start,$date_of_end);
     * This function updates the data in the database.
     * Table:
     *      banners
     * Inputs:
     *      $banner_id = int
     *      $user_id = int
     *      $date_of_start = date
     *      $date_of_end =  date
     */
    function update_date($banner_id,$user_id,$date_of_start,$date_of_end){
        $result = mysql_query("UPDATE `banners` SET `dateofstart`= '$date_of_start',`dateofend` = '$date_of_end' WHERE `id` =  '$banner_id' AND `user_id` = '$user_id'")
        or die(mysql_error());
    }

    /*
     * update_status($banner_id,$user_id,$status);
     * This function updates the data in the database.
     * Table:
     *      banners
     * Inputs:
     *      $banner_id = int
     *      $user_id = int
     *      $status = boolean
     */
    function update_status($banner_id,$user_id,$status){
        $result = mysql_query("UPDATE `banners` SET `status`= '$status'WHERE `id` =  '$banner_id' AND `user_id` = '$user_id'")
        or die(mysql_error());
    }

    /*
     * insert($user_id,$banner_name,$link,$status,$width,$height,$date_of_start,$date_of_end);
     * This function updates the data in the database.
     * Table:
     *      banners
     * Inputs:
     *      $user_id = int
     *      $banner_name = String
     *      $status = boolean
     *      $width = int
     *      $height = int
     *      $date_of_start = date
     *      $date_of_end = date
     *      $content = String
     */
    function insert($user_id,$banner_name,$status,$width,$height,$date_of_start,$date_of_end,$content){
        $resutl = mysql_query("INSERT INTO `banners` (`user_id`, `name`, `status`, `width`, `height`, `dateofstart`, `dateofend`, `content`)
          VALUES ('$user_id', '$banner_name', '$status', '$width', '$height', '$date_of_start', '$date_of_end', '$content')") or die(mysql_error());

    }

    /*
     * update($banner_id,$user_id,$banner_name,$link,$status,$width,$height,$date_of_start,$date_of_end);
     * This function updates the data in the database.
     * Table:
     *      banners
     * Inputs:
     *      $banner_id = int
     *      $user_id = int
     *      $banner_name = String
     *      $status = boolean
     *      $width = int
     *      $height = int
     *      $date_of_start = date
     *      $date_of_end = date
     *      $content = String
     */
    function update($banner_id,$user_id,$banner_name,$status,$width,$height,$date_of_start,$date_of_end, $content){
        $result = mysql_query("UPDATE `banners` SET `name` = '$banner_name', `status`= '$status' ,`width`='$width',`height`='$height',`dateofstart`='$date_of_start',`dateofend`='$date_of_end', `content`='".$content."'
        WHERE `id` =  '$banner_id' AND `user_id` = '$user_id'") or die(mysql_error());
    }

    /*
     * find_by_name($name,$user_id);
     * This function fetches from the database.
     * Table:
     *      banners
     * Inputs:
     *      $name = String
     *      $user_id = int
     */
    function find_by_name($name,$user_id){
        $result = mysql_query("SELECT id FROM banners WHERE `name` = '$name' AND `user_id` = '$user_id'") or die(mysql_error());
        return $result;
    }

    /*
     * This function gets data of banner from database.
     * Table:
     *      banners
     * Inputs:
     *      $id = int
     *      $user_id = int
     */
    
    function select_banner($id,$user_id){
        $result = mysql_query("SELECT * FROM `banners` WHERE id = $id AND user_id = $user_id") or die(mysql_error());
        return $result;
    }

    /*
     * This function deletes banner from database.
     * Table:
     *      banners
     * Inputs:
     *      $user_id = int
     *      $banner_id = int
     */
    function delete($user_id,$banner_id){
        $result = mysql_query("DELETE FROM `banners` WHERE user_id = $user_id AND id = $banner_id") or die(mysql_error());
    }

}

