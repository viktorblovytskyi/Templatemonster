<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Leito
 * Date: 05.04.2015
 * Time: 21:00
 *
 * Class Banner:
 *
 * Properties:
 *  private:
 *      $user_id = int
 *      $banner_name = String
 *      $width = int
 *      $height = int
 *      $content = String
 *      $date_of_start = String
 *      $date_of_end = String
 *      $status = Boolean
 *      $banner_id = int
 *
 * Methods:
 *      select_function($array);
 *      create_banner();
 *      update_banner();
 *      loadData($banner_id);
 *      find_banner();
 *      display_banner($content,$height,$width)
 *      show_user_banners();
 *      delete_banner($banner_id);
 *      show_form();
 *      update_banner_status($banner_id);
 *      Get and set methods
 */

class Banner {
    private $user_id;
    private $banner_name;
    private $width;
    private $height;
    private $content;
    private $date_of_start;
    private $date_of_end;
    private $status;
    private $banner_id;


    function __construct($user_id){
        $this->user_id = $user_id;

    }

    /**
     * @return mixed
     */
    public function getBannerName()
    {
        return $this->banner_name;
    }

    /**
     * @param mixed $banner_name
     */
    public function setBannerName($banner_name)
    {
        $this->banner_name = $banner_name;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDateOfStart()
    {
        return $this->date_of_start;
    }

    /**
     * @param mixed $date_of_start
     */
    public function setDateOfStart($date_of_start)
    {
        $this->date_of_start = $date_of_start;
    }

    /**
     * @return mixed
     */
    public function getDateOfEnd()
    {
        return $this->date_of_end;
    }

    /**
     * @param mixed $date_of_end
     */
    public function setDateOfEnd($date_of_end)
    {
        $this->date_of_end = $date_of_end;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /*
     * This function processes the received data and selects a method for processing query;
     * Inputs:
     *      $array = Array;
     */
    public function select_function($array){
        $tools = new Tools();
        if($array['button']=='create'){
            $this->setBannerName($array['banner_name']);
            $this->setContent($array['content']);
            $this->setHeight($array['height']);
            $this->setWidth($array['width']);
            $this->setDateOfStart($array['date_of_start']);
            $this->setDateOfEnd($array['date_of_end']);
            if(strnatcasecmp($array['status'],'on')==0){
                $this->setStatus(true);
            }else{
                $this->setStatus(false);
            }
            if($tools->check_banner($array)==true){
                $this->create_banner();
            }else{
                $this->show_form('create');
                echo 'Error!';
            }
        }elseif($array['button']=='update'){
            $this->setBannerName($array['banner_name']);
            $this->banner_id=$array['id'];
            $this->setContent($array['content']);
            $this->setHeight($array['height']);
            $this->setWidth($array['width']);
            $this->setDateOfStart($array['date_of_start']);
            $this->setDateOfEnd($array['date_of_end']);
            if(strnatcasecmp($array['status'],'on')==0){
                $this->setStatus(true);
            }else{
                $this->setStatus(false);
            }
            if($tools->check_banner($array)==true){
                $this->update_banner();
            }else{
                $this->show_form('update');
                echo 'Error!';
            }

        }
    }

    /*
     * This function adds banner in database;
     */
    private function create_banner(){
        $gateway = Tools::factory("BannerGateway");
        //check for the presence of a banner with the same name in the database
        if(mysql_fetch_array($gateway->find_by_name($this->banner_name,$this->user_id))>=1){
            echo "Banner already exists";
            return 0;
        }
        $gateway->insert($this->user_id,$this->banner_name,$this->status,$this->width,$this->height,$this->date_of_start,$this->date_of_end,$this->content);//***************************************
        exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
    }

    /*
     * This function loads information from database.
     * Inputs:
     *      $banner_id = int;
     */
    public function loadData($banner_id){
        $gateway = Tools::factory("BannerGateway");
        $result = mysql_fetch_array($gateway->select_banner($banner_id,$this->user_id));
        $this->banner_id=$banner_id;
        $this->setBannerName($result['name']);
        $this->setContent($result['content']);
        $this->setHeight($result['height']);
        $this->setWidth($result['width']);
        $this->setDateOfStart($result['dateofstart']);
        $this->setDateOfEnd($result['dateofend']);
        $this->setStatus($result['status']);

    }

    /*
     *  This function update banner's information in database.
     */
    private function  update_banner(){
        $gateway = Tools::factory("BannerGateway");
        $gateway->update($this->banner_id,$this->user_id,$this->banner_name,$this->status,$this->width,$this->height,$this->date_of_start,$this->date_of_end,$this->content);
        exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
    }

    /*
     * This function displays all user's banners.
     */
    function show_user_banners(){
        $gateway = Tools::factory("BannerGateway");
        $banners=$gateway->find_users_banner($this->user_id);

        echo " <table>
                <tr>
                <td>name</td>
                <td>width</td>
                <td>height</td>
                <td>date of start</td>
                <td>date of end</td>
                <td>status</td>
                <td></td></tr>";
        while($row=mysql_fetch_array($banners)){
            if(strnatcasecmp($row['status'],"1")==0){
                $status='on';
            }else{
                $status="off";
            }
            echo "<tr><td><a href='?type=update&id=".$row['id']."'>". $row['name']."</a> </td><td> ". $row['width']." </td><td>" . $row['height']. " </td><td>". $row['dateofstart']."</td><td>".$row['dateofend']."</td><td><a href='?type=change&id=".$row['id']."'>  ".$status."</a> </td><td><a href='?type=delete&id=".$row['id']."'>Delete</a></td><td><a href='?type=add_page&id=".$row['id']."'>Add page</a></td><td><a href='?type=pages&id=".$row['id']."'>Pages</a></td></tr>";
        }
        echo"</table>";

    }

    /*
     * This function find banners in database and display banners on the page.
     * Uses method display_banner($content, $height, $width);
     */
    public function find_banner(){
        //Gets server's date in format "YEAR-MONTH-DAY" "2013-03-12"
        $date = date("o-m-d");
        $gateway = Tools::factory("BannerGateway");
        $banners = $gateway->find_users_banner_on($this->user_id);
        $parsed=array();
        while($row=mysql_fetch_array($banners)){
            $check_date=($row['dateofstart']<=$date and $row['dateofend']>=$date);
            if($check_date == true){
                $parsed[] = $row;
            }
        }
        if(count($parsed)>=1){
            $i= rand(0, count($parsed)-1);
            $this->display_banner($parsed[$i]['content'],$parsed[$i]['height'],$parsed[$i]['width']);
        }elseif(count($parsed)==0){
            echo "";
        }else{
            $i=0;
            $this->display_banner($parsed[$i]['content'],$parsed[$i]['height'],$parsed[$i]['width']);
        }
    }

    /*
     * This function display banners on the page in <iframe>.
     * Inputs:
     *      $content = String
     *      $height = int
     *      $width = int
     */
    function display_banner($content,$width,$height){
        echo '<iframe src="show_content.php?content='.$content.'" width="'.$width.'" height="'.$height.'" scrolling="no">
                    Ваш браузер не поддерживает плавающие фреймы!
            </iframe><br>';
    }

    /*
     * This function delete banner from database.
     * Inputs:
     *      $banner_id = int
     */
    public function delete_banner($banner_id){
        $gateway = Tools::factory("BannerGateway");
        $gateway->delete($this->user_id,$banner_id);
        exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
    }

    /*
     * This function update banner's status.
     * First function gets the current status and then change it to the opposite.
     * Inputs:
     *      $banner_id = int
     */
    public function update_status($banner_id){
        $gateway = Tools::factory("BannerGateway");
        //Get the status of a banner
        $result = mysql_fetch_array($gateway->select_banner($banner_id,$this->user_id));
        //Change the status reversed value
        if($result['status']=='1'){
            $status=false;
        }else{
            $status = true;
        }
        $gateway->update_status($banner_id,$this->user_id,$status);
        exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
    }

    /*
     * This function displays form for create and update banner.
     */
    function show_form($query_type){
        if($this->status=='1'){
            $checked='checked';
        }elseif($this->status=='0'){
            $checked='';
        }
        echo '<table>
    <form name="create" action=index.php method="POST">
    <input type="hidden" name="id" value="'.$this->banner_id.'">
        <tr>
            <td colspan="1">Name</td>
            <td colspan="3"><input size="20" type=text name="banner_name" value="'.$this->getBannerName().'"></td>
        </tr>
        <tr>
            <td>Width</td>
            <td>
                <input type="number" name="width" value="'.$this->getWidth().'">
            </td>
            <td>Height</td>
            <td>
                <input type="number" name="height" value="'.$this->getHeight().'">
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <textarea rows="20" cols="60"  name="content">'.$this->getContent().'</textarea>
            </td>
        </tr>
        <tr>
            <td>Date of start</td>
            <td>
                <input type="date" name="date_of_start" value="'.$this->getDateOfStart().'">
            </td>
            <td>Date of end</td>
            <td>
                <input type="date" name="date_of_end" value="'.$this->getDateOfEnd().'">
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td><input type="checkbox" name="status" '.$checked.'></td>
            <td colspan="2"><input type="submit" name="button" value="'.$query_type.'"></td>
        </tr>
        <tr>
            <td></td><td></td><td><a href="index.php">Close</a></td>
        </tr>
    </form>
    </table>';
    }


}



