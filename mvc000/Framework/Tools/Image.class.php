<?php


namespace Framework\Tools;


class Image{
    //定义一个报错的静态属性
    public static $err;
    public static function upflie($img){
        /*
        * 1. 判断上传文件的有效性
        * 2. 生成文件名
        * 3. 将临时文件移动到新的位置
        */

        if($img['error']>0){//固定的写法
            self::$err='文件上传出错';
            return false;
        }
        //1.2 判断文件大小
        if($img['size']>2*1024*1024){
            self::$err='文件太大无法上传';
            return false;
        }
        //判断文件类型
        $type=['image/jpeg','image/png','image/gif'];//允许上传的文件类型
        if(!in_array($img['type'],$type)){//检查数组中是否存在该类型
            self::$err='该文件类型不准确';
            return false;
        }
        //生成文件名
        $filename=uniqid('img_');//生成唯一的
        $ext=strrchr($img['name'],'.');//查找指定字符在字符串中的最后一次出现
        $dir='./Uploads/';
        $fullname=$dir.$filename.$ext;//生成文件名

        //3. 将临时文件移动到指定的目录
                                  //临时文件名
        $r=move_uploaded_file($img['tmp_name'],$fullname);
        if($r){
            return $fullname;
        }else{
            self::$err='临时文件移动时出错';
            return false;
        }
    }
    //制作缩略图
    public static function thumb($path,$w=100,$h=100){
        //创作原画图画布和缩略图画布
        $source=imagecreatefromjpeg($path);
        $src_w=imagesx($source);//原图的宽
        $src_h=imagesy($source);//原图的高
        $len=min($src_w,$src_h);//取最小的边作为截取点
        $local=(max($src_w,$src_h)-$len)/2;//用最大的边减去最小的边在除以2截取到中间的位置
        $thumb=imagecreatetruecolor($w,$h);

        //采样复制图片
        if($src_w>$src_h){
            imagecopyresampled($thumb,$source,0,0,$local,0,$w,$h,$len,$len);
        }else{
            imagecopyresampled($thumb,$source,0,0,0,$local,$w,$h,$len,$len);
        }
        //3. 存储图片
        $filename=str_replace('.jpg','_100x100.jpg',$path);
        imagejpeg($thumb,$filename);
        imagedestroy($thumb);
        imagedestroy($source);
        return $filename;
    }


}