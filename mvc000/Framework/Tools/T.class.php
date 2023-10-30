<?php
namespace Framework\Tools;

class T{
    public static function p($str){
        $arr=func_get_args();
        foreach($arr as $v){
            echo $v;
            echo ' ';
        }
        echo '<br/>';
    }

    public static function dump($str){
        $arr=func_get_args();
        foreach($arr as $v){
            var_dump($v);
            echo ' ';
        }
        echo '<br/>';
    }

    public static function jump($str,$url){
        header("Refresh:1; $url");
        echo "<h1>$str</h1>";
        exit;
    }
}