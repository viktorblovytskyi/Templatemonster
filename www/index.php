<?php
session_start();
include('authorization.php');
include('Banner.php');
if(USER_LOGGED) {
    if(!check_user($user_id)) logout();
    echo"<a href='create_and_update_banner.php'>Create banner</a> ";
    echo"<a href='?logout'>Выход</a>";
    $banners = new Banner();
    $banners ->show_user_banners($user_id);

}
else {
    sign_in();
}
