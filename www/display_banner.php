<?php
/**
 * Created by PhpStorm.
 * User: Leito
 * Date: 19.04.2015
 * Time: 23:29
 */
include("scripts/Tools.php");
include('scripts/Banner.php');

$banner = new Banner($_GET['user_id']);
$banner->find_banner();



