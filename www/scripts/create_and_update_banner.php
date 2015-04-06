<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Leito
 * Date: 05.04.2015
 * Time: 21:31
 */
include("Tools.php");
if(USER_LOGGED) {
?>
    <table>
    <form name="create" action=Banner.php method="POST">
        <tr>
            <td colspan="1">Name</td>
            <td colspan="3"><input size="20" type=text autofocus="autofocus" name=banner_name></td>
        </tr>
        <tr>
            <td>Width</td>
            <td>
                <input type="number" name="width">
            </td>
            <td>Height</td>
            <td>
                <input type="number" name="height">
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <textarea rows="20" cols="60"  name="content"></textarea>
            </td>
        </tr>
        <tr>
            <td>Date of start</td>
            <td>
                <input type="date" name="date_of_start">
            </td>
            <td>Date of end</td>
            <td>
                <input type="date" name="date_of_end">
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td><input type="checkbox" name="status"></td>
            <td colspan="2"><input type="submit" name="Send"></td>
        </tr>
    </form>
    </table>
<?php


}else{
    sign_in();
}