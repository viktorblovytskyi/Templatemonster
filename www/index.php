<?php
    session_start();
    mysql_connect('localhost','root') or die(mysql_error());
    mysql_select_db('banadmin') or die(mysql_error());

    include('authentication.php');

    if(USER_LOGGED) {
    if(!check_user($user_id)) logout();
    ?>
    <h1>������������, <?php echo $login; ?>!</h1>
    <h2>��� ID: <?php echo $user_id; ?>.</h2>
    <h4><a href="?logout">�����</a></h4>
<?php
}
else { ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table>
            <tr>
                <td>���:</td><td><input type="text" name="user"></td>
            </tr>
            <tr>
                <td>������:</td><td><input type="password" name="pass"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="login" value="�����"></td>
            </tr>
        </table>
    </form>
<?php
}
?>
