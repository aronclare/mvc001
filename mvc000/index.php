<?php
header('Content-Type:text/html; charset=utf-8');

require 'Application/Config/application.config.php';

$p=$_GET['p'] ?? D_PLATFORM;
$c=$_GET['c'] ?? D_CONTROLLER;
$a=$_GET['a'] ?? D_METHOD;

$classname="Application\\Controller\\{$p}\\{$c}Controller";

/*function myAutoloader($classname) {
    $classname =str_replace("\\",'/',$classname);
    include "{$classname}.class.php";
}
spl_autoload_register('myAutoloader');*/

//var_dump($classname);die;
spl_autoload_register(function($classname) {
    $classname = str_replace("\\", '/', $classname);
    require "{$classname}.class.php";
});

$obj=new $classname();
$obj->$a();
