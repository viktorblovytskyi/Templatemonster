<?php
define('SESSION_ID',session_id());

function logout() {
    unset($_SESSION['user_id']);
    die(header('Location: '.$_SERVER['PHP_SELF']));
}

function login($login,$password){
    $result = mysql_query("SELECT * FROM  `users` WHERE login =  '$login' AND PASSWORD =  '$password'")
    or die(mysql_error());
    $USER = mysql_fetch_array($result,1);
    if(!empty($USER)) {
        $_SESSION = array_merge($_SESSION,$USER);
        mysql_query("UPDATE `users` SET session_id='".SESSION_ID."' WHERE user_id='".$USER['user_id']."';")
        or die(mysql_error());
        return true;
    }
    else {
        return false;
    }
}

function check_user($user_id) {
    $result = mysql_query("SELECT session_id FROM `users` WHERE user_id = '$user_id';") or die(mysql_error());
    $session_id = mysql_result($result,0);
    return $session_id==SESSION_ID ? true : false;
}

if(isset($_SESSION['user_id'])) {
    define('USER_LOGGED',true);
    $login = $_SESSION['login'];
    $password = $_SESSION['password'];
    $user_id = $_SESSION['user_id'];
}
else {
    define('USER_LOGGED',false);
}


if (isset($_POST['login'])) {

    if(get_magic_quotes_gpc()) {
        $_POST['user']=stripslashes($_POST['user']);
        $_POST['pass']=stripslashes($_POST['pass']);
    }
    $user = mysql_real_escape_string($_POST['user']);
    $pass = mysql_real_escape_string($_POST['pass']);
    if(login($user,$pass)) {
        header('Refresh: 3');
        die('Вы успешно авторизировались!');
    }
    else {
        header('Refresh: 3;');
        die('Пароль неправильный!');
    }

}

if(isset($_GET['logout'])) {
    logout();
}
?>