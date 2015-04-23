<?php
include("scripts/Tools.php");

define('SESSION_ID',session_id());
/*
 * This function closes session and user logoff.
 */
function logout() {
    unset($_SESSION['user_id']);
    exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
}


/*
 * This function starts session if user's login and password checked.
 * Input:
 *      $login - String
 *      $password - String
 */
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
        echo 'Вы успешно авторизировались!';
        exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
    }else {
        echo 'Пароль неправильный!';
        exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
    }

}
/*
 * Call function logout()
 */
if(isset($_GET['logout'])) {
    logout();
}

/*
 * This function shows authorization's form.
 */
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
