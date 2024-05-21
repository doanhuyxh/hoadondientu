<?php

define('_DIR_ROOT', __DIR__);//load đường dẫn vật lý thư mục chứa dự án

//xử lý giao thức protoco
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = 'https://'.$_SERVER['HTTP_HOST'];
}
else {
    $web_root = 'http://'.$_SERVER['HTTP_HOST'];
}

$folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', strtolower(__DIR__));

$web_root = $web_root."";

define("_WEB_ROOT", $web_root); 

error_reporting(0);
require_once "configs/routes.php";//định nghĩa các router
require_once "configs/database.php";// định nghĩa thông tin của sơ sở dữ liệu
require_once "core/Route.php"; //load đường dẫn ảo
require_once 'core/Model.php';// load cơ sở dữ liệu
require_once "app/App.php";//Load app
require_once 'core/Controller.php';//Load base controller

?>