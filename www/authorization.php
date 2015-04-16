<?php
include("scripts/Tools.php");

define('SESSION_ID',session_id());

function logout() {
    unset($_SESSION['user_id']);
    die(header('Location: '.$_SERVER['PHP_SELF']));
}

function login($login,$password){
    $gateway = Tools::factory('UserGateway');
    $tools = new Tools();
    if(!$tools->check_user_login($login)){
        return false;
    }
    if(!$tools->check_user_password($password)){
        return false;
    }
    $USER = $gateway->findUserByLoginAndPassword($login,$password);
    if(!empty($USER)) {
        $_SESSION = array_merge($_SESSION,$USER);
        return true;
    }else{
        return false;
    }
}

function check_user($user_id) {
    $gateway = Tools::factory('UserGateway');
    $result =$gateway->findUserById($user_id);

    return $result;
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
        header('Refresh: 1');
        die('Вы успешно авторизировались!');
    }else {
        header('Refresh: 3;');
        die('Пароль неправильный!');
    }

}

if(isset($_GET['logout'])) {
    logout();
}

function sign_in(){
    echo"<form method='POST' action=".$_SERVER['PHP_SELF'].">
            <table>
                <tr>
                    <td>Login:</td><td><input type='text' name='user'></td>
                </tr>
                <tr>
                    <td>Password:</td><td><input type='password' name='pass'></td>
                </tr>
                <tr>
                    <td colspan='2'><input type='submit' name='login' value='Sign in'></td>
                </tr>
            </table>
        </form>";
}
