<?php
/**
 * Created by PhpStorm.
 * User: Leito
 * Date: 18.04.2015
 * Time: 2:28
 *
 * Class Pages:
 *
 * Properties:
 *      $banner_id = int;
 * Methods:
 *      show_form();
 *      add_page($link);
 *      show_page();
 *      delete_page($id);
 *
 */

class Pages {
    private $banner_id;

    function __construct($banner_id){
        $this->banner_id=$banner_id;
    }

    /*
     * This function displays a form to add links.
     */
    function show_form(){
        echo '<form name="page" action="index.php" method="POST">
                <input type="hidden" name="id" value="'.$this->banner_id.'">
                <input type="text" name="link"/>
                <input type="submit" name="page_button"/>
            </form>
            <a href="index.php">Close</a>';
    }

    /*
     * This function adds new link in data.
     * Inputs:
     *      $link - String
     */
    function add_page($link){
        $gateway = Tools::factory("PagesGateway");
        $gateway->insert($this->banner_id,$link);
    }

    /*
     * This function displays all the links which displays banner.
     */
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

    /*
     * This function delete link fro database.
     * Inputs:
     *      $id - int.
     */
    function delete_page($id){
        $gateway = Tools::factory("PagesGateway");
        $gateway->delete($id);
    }

    function find_pages($url){
        $gateway = Tools::factory("PagesGateway");
        $pages=$gateway->select($this->banner_id);
        while($row=mysql_fetch_array($pages)){
            $parsed[] = $row;
        }
        for($i=0;$i<=count($parsed);$i++){
            if(count($parsed)>=1){
                if($this->banner_id==$parsed[$i]['banner_id']&&$url==$parsed[$i]['link']){
                    $gateway->update_visits($parsed[$i]['id']);
                    return 1;
                }else{
                    return -1;
                }
            }else{
                return 0;
            }
        }
    }
}