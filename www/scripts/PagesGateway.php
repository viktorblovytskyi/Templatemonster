<?php
/**
 * Created by PhpStorm.
 * User: Leito
 * Date: 18.04.2015
 * Time: 2:28
 */

class PagesGateway {
    function __construct(){
        $tools = new Tools();
        $tools->connect('localhost','user','','banadmin');
    }

}