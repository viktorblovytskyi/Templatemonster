<?php

session_start();
include('authorization.php');
include('scripts/Banner.php');
include('scripts/Pages.php');
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
    if(isset($_GET['type'])&&$_GET['type']=='change'){
        $banners->update_status($_GET['id']);
    }
    if(isset($_GET['type'])&&$_GET['type']=='add_page'){
        $page = new Pages($_GET['id']);
        $page->show_form();
    }
    if(isset($_POST['page_button'])){
        $page = new Pages($_POST['id']);
        $page->add_page($_POST['link']);
    }
    if(isset($_GET['type'])&&$_GET['type']=='pages'){
        $page = new Pages($_GET['id']);
        $page->show_pages();
    }
    if(isset($_GET['type'])&&$_GET['type']=='delete_page'){
        $page = new Pages($_GET['id']);
        $page->delete_page($_GET['id']);
    }
}
else {
    sign_in();
}
