<?php
/**
 * Created by PhpStorm.
 * User: Leito
 * Date: 03.04.2015
 * Time: 1:12
 */
/*
 * INSERT INTO `banadmin`.`banners` (`user_id`, `name`, `link`, `status`, `width`, `height`, `dateofstart`, `dateofend`)
 *  VALUES ('1', 'banner2', 'http://banadmin.com/index2.php', 'true', '100', '100', '2015-04-21', '2015-04-30')
 */
class BannerGateway {
    function find_users_banner($user_id){
        $tools = new Tools();
        $tools->connect('localhost','user','','banadmin');
        //$link = mysql_connect('localhost','user') or die(mysql_error());
        //mysql_select_db('banadmin') or die(mysql_error());
        $result = mysql_query("SELECT * FROM banners WHERE user_id = $user_id");
        return mysql_fetch_array($result);
    }
    function update_date($banner_id,$user_id,$date_of_start,$date_of_end){
        $tools = new Tools();
        $tools->connect('localhost','user','','banadmin');
        //$link = mysql_connect('localhost','user') or die(mysql_error());
        //mysql_select_db('banadmin') or die(mysql_error());
        $result = mysql_query("UPDATE `banners` SET `dateofstart`= '$date_of_start',`dateofend` = '$date_of_end' WHERE `banner_id` =  '$banner_id' AND `user_id` = '$user_id'")
        or die(mysql_error());
    }
    function update_status($banner_id,$user_id,$status){
        $tools = new Tools();
        $tools->connect('localhost','user','','banadmin');
        //$link = mysql_connect('localhost','user') or die(mysql_error());
        //mysql_select_db('banadmin') or die(mysql_error());
        $result = mysql_query("UPDATE `banners` SET `status`= '$status'WHERE `banner_id` =  '$banner_id' AND `user_id` = '$user_id'")
        or die(mysql_error());
    }
    function insert($user_id,$banner_name,$link,$status,$width,$height,$date_of_start,$date_of_end){
        $tools = new Tools();
        $tools->connect('localhost','user','','banadmin');
        //$link = mysql_connect('localhost','user') or die(mysql_error());
        //mysql_select_db('banadmin') or die(mysql_error());
        $resutl = mysql_query("INSERT INTO `banners` (`user_id`, `name`, `link`, `status`, `width`, `height`, `dateofstart`, `dateofend`)
          VALUES ('$user_id', '$banner_name', '$link', '$status', '$width', '$height', '$date_of_start', '$date_of_end')") or die(mysql_error());

    }
    function update($banner_id,$user_id,$banner_name,$link,$status,$width,$height,$date_of_start,$date_of_end){
        $tools = new Tools();
        $tools->connect('localhost','user','','banadmin');
        //$link = mysql_connect('localhost','user') or die(mysql_error());
        //mysql_select_db('banadmin') or die(mysql_error());
        $result = mysql_query("UPDATE `banners` SET `name` = '$banner_name',`link`='$link',`status`= '$status',`width`='$width',`height`='$height',`dateofstart`='$date_of_start',`dateofend`='$date_of_end'
                               WHERE `banner_id` =  '$banner_id' AND `user_id` = '$user_id'") or die(mysql_error());
    }

}
