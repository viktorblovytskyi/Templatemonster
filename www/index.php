<?php
session_start();
include('authorization.php');
//include('Banner.php');
if(USER_LOGGED) {
    if(!check_user($user_id)) logout();
    echo "<a href='scripts/create_and_update_banner.php'>Create banner</a> ";
    echo"<a href='?logout'>Выход</a>";
    $banners = Tools::factory('Banner');
    $banners ->show_user_banners($user_id);

}
else {
    sign_in();
}
