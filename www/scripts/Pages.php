x<?php
/**
 * Created by PhpStorm.
 * User: Leito
 * Date: 18.04.2015
 * Time: 2:28
 */

class Pages {
    private $banner_id;
    function __construct($banner_id){
        $this->banner_id=$banner_id;
    }
    function show_form(){
        echo '<form name="page" action="index.php" method="POST">
                <input type="hidden" name="id" value="'.$this->banner_id.'">
                <input type="text" name="link"/>
                <input type="submit" name="page_button"/>
            </form>
            <a href="index.php">Close</a>';
    }
    function add_page($link){
        $gateway = Tools::factory("PagesGateway");
        $gateway->insert($this->banner_id,$link);
    }
    function show_pages(){
        $gateway = Tools::factory("PagesGateway");
        $pages=$gateway->select($this->banner_id);
        echo " <table>
                <tr>
                <td>link</td>
                <td>visits</td>
                </tr>";
        while($row=mysql_fetch_array($pages)){
            echo "<tr><td>". $row['link']."</td><td>".$row['visits']."</td><td><a href='?type=delete_page&id=".$row['id']."'>Delete</a></td></tr>";
        }
        echo"</table><br><a href='index.php'>Close</a>";
    }
    function delete_page($id){
        $gateway = Tools::factory("PagesGateway");
        $gateway->delete($id);
    }
}