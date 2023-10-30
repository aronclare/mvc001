<?php
namespace Framework\Tools;

final class Db{
    private $host;
    private $user;
    private $password;
    private $dbname;
    private $port;
    private $charset;
    private $link;
    private static $obj;


    private function __construct($host,$user,$pwd,$dbname,$port=3306,$charset='utf8'){
        $this->host=$host;
        $this->user=$user;
        $this->password=$pwd;
        $this->dbname=$dbname;
        $this->port=$port;
        $this->charset=$charset;

        $this->conn();
        $this->setCharset();
    }

    private function conn(){
        $this->link=@mysqli_connect($this->host,$this->user,$this->password,$this->dbname,$this->port);
        $this->testError($this->link,'数据库连接失败',1);
    }

    private function setCharset(){
        $result=mysqli_set_charset($this->link,$this->charset);
        $this->testError($result,'设置字符集失败');
    }

    private function testError($result,$str,$type=2){
        if($result === false){
            echo $str.'<br/>';
            if($type==1){
                echo '错误：'.mysqli_connect_error();
            }elseif($type==2){
                echo '错误：'.mysqli_error($this->link);
            }
            exit('<br/>');
        }
        return $result;
    }

    public function query($sql){
        $rs=mysqli_query($this->link,$sql);
        $rs=$this->testError($rs,'SQL语句执行失败');
        return $rs;
    }

    public function __destruct(){
        if($this->link){
            mysqli_close($this->link);
        }
    }

    public function fetchAll($sql){
        $rs=mysqli_query($this->link,$sql);
        return mysqli_fetch_all($rs,1);
    }

    public function fetchRow($sql,$type=1){
        $rs=$this->query($sql);

        if($type==1){
            return mysqli_fetch_assoc($rs);
        }elseif($type==2){
            return mysqli_fetch_row($rs);
        }elseif($type==3){
            return mysqli_fetch_array($rs);
        }
    }

    public function fetchColumn($sql){
        $rs=mysqli_query($this->link,$sql);
        $row=mysqli_fetch_row($rs);
        return $row[0];
    }

    public function __wakeup(){
        T::p('反序列化，重新连接数据库@！！！');
        $this->conn();
        $this->setCharset();
    }

    public static function create(){
        if(!self::$obj){
            self::$obj=new self(HOST,USER,PASSWORD,DBNAME,PORT,CHARSET);
        }

        return self::$obj;
    }

    private function __clone(){}
}