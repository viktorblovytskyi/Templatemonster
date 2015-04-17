<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Leito
 * Date: 05.04.2015
 * Time: 21:00
 */
//include('scripts/Tools.php');
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
    public function print_data(){
        echo "$this->banner_id $this->user_id $this->banner_name $this->status $this->height $this->width $this->date_of_start $this->date_of_end $this->content";
    }

    public function select_function($array){
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
            $this->create_banner();
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
            $this->update_banner();
        }
    }

    private function create_banner(){
        $gateway = Tools::factory("BannerGateway");
        if(mysql_fetch_array($gateway->find_by_name($this->banner_name,$this->user_id))>=1){//пропускает баннеры с одинаковыми именами****************
            echo "Banner already exists";
            return 0;
        }
       if(!isset($this->status)){
            $this->status = false;
        }else{
            $this->status = true;
        }
        $gateway->insert($this->user_id,$this->banner_name,$this->status,$this->width,$this->height,$this->date_of_start,$this->date_of_end,$this->content);//***************************************
        exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
    }
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
    private function  update_banner(){
        $gateway = Tools::factory("BannerGateway");
        $gateway->update($this->banner_id,$this->user_id,$this->banner_name,$this->status,$this->width,$this->height,$this->date_of_start,$this->date_of_end,$this->content);
        exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
    }
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
            echo "<tr><td><a href='?type=update&id=".$row['id']."'>". $row['name']."</a> </td><td> ". $row['width']." </td><td>" . $row['height']. " </td><td>". $row['dateofstart']."</td><td>".$row['dateofend']."</td><td><a href='?type=change&id=".$row['id']."'>  ".$status."</a> </td><td><a href='?type=delete&id=".$row['id']."'>Delete</a></td></tr>";
        }
        echo"</table>";

    }
    public function delete_banner($banner_id){
        $gateway = Tools::factory("BannerGateway");
        $gateway->delete($this->user_id,$banner_id);
        exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
    }
    public function update_status($banner_id){
        $gateway = Tools::factory("BannerGateway");
        $result = mysql_fetch_array($gateway->select_banner($banner_id,$this->user_id));
        if($result['status']=='1'){
            $status=false;//izminenie na protivopolojnoe znachenie
        }else{
            $status = true;
        }
        $gateway->update_status($banner_id,$this->user_id,$status);
        exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
    }
    function show_form($query_type){
        if($this->status=='1'){
            $checked='checked';
        }elseif($this->status=='0'){
            $checked='';
        }

        echo '<table>
    <form name="create" action=index.php method="POST">
    <input type="hidden" name="banner_id" value="'.$this->banner_id.'">
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



