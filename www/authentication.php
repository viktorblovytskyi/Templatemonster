<?php
include("script/UserGateway.php");

define('SESSION_ID',session_id());

function logout() {
    unset($_SESSION['user_id']);
    die(header('Location: '.$_SERVER['PHP_SELF']));
}

function login($login,$password){
    $ug = new UserGatewayClass();
    $USER = $ug->findUserByLoginAndName($login,$password);
    if(!empty($USER)) {
        $_SESSION = array_merge($_SESSION,$USER);
        $ug->updateSessionId(SESSION_ID,$USER['user_id']);
        return true;
    }
    else {
        return false;
    }
}

function check_user($user_id) {
    $ug = new UserGatewayClass();
    $session_id =$ug->findUserById($user_id);
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