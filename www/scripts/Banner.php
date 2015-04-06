<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Leito
 * Date: 05.04.2015
 * Time: 21:00
 */
//include('scripts/Tools.php');
class Banner {

    function create_banner(){
        $tool = new Tools();
        $gateway = Tools::factory("BannerGateway");
        if($gateway->find_by_name($_POST['name'],$_SESSION['user_id'])>=1){//пропускает баннеры с одинаковыми именами****************
            header('Refresh: 3');
            die('Banner with the same name already exists!');
        }
        $link = "http://banadmin.com/banners/".$_SESSION['user_id']."_".$_POST['name'].".html";
        if(!isset($_POST['status'])){
            $status = false;
        }else{
            $status = true;
        }
        $tool->write_in_file($_POST['banner_name'],$_POST['content']);
        $gateway->insert($_SESSION['user_id'],$_POST['banner_name'],$link,$status,$_POST['width'],$_POST['height'],$_POST['dateofstart'],$_POST['dateofend']);//***************************************
        header('Location: index.php ');
        die('Banner created successfully!');
    }
    function  update_banner($banner_id){

    }
    function show_user_banners($user_id){//***********************************
        $gateway = Tools::factory("BannerGateway");
        $banners=$gateway->find_users_banner($user_id);
        echo " <table>
                <tr>
                <td>id</td>
                <td>name</td>
                <td>link</td>
                <td>status</td>
                <td>width</td>
                <td>height</td>
                <td>date of start</td>
                <td>date of end</td>
                <td>change</td></tr>";
        while($row=mysql_fetch_array($banners)){
            if($row['status']==1){
                $status='checked';
            }
            echo "<tr><td><a href='?id=".$row['banner_id']."'>".$row['banner_id']."</a></td><td>". $row['name']." </td><td>". $row['link']." </td><td>: <input type='checkbox' $status > </td><td> ". $row['width']." </td><td>" . $row['height']. " </td><td>". $row['dateofstart']."</td><td>".$row['dateofend']."</td></tr>";
        }
        echo"</table>";
    }

}

