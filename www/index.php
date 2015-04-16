<?php
session_start();
include('authorization.php');

include('scripts/Banner.php');
if(USER_LOGGED) {
    if(!check_user($user_id)) logout();
    echo "<a href='?type=create'>Create banner</a> ";
    echo"<a href='?logout'>Выход</a>";
    $banners = new Banner($user_id);
    $banners ->show_user_banners($user_id);
    echo "<br>";
    if(isset($_GET['id'])&&$_GET['type']=='update'){
        $banners->loadData($_GET['id']);
        $banners->show_form($_GET['type']);
    }
    if(isset($_GET['type'])&&$_GET['type']=='create'){
        $banners->show_form($_GET['type']);
    }
    if(isset($_POST['button'])){
        $banners->select_function($_POST);
    }
    if(isset($_GET['type'])&&$_GET['type']=='delete'){
        $banners->delete_banner($_GET['id']);
    }
}
else {
    sign_in();
}
