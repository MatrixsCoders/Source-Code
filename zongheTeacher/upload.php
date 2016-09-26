<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/9/26
 * Time: 下午3:37
 */

print_r($_FILES);
$file = $_FILES["file"];
header("Content-type:text/html;charset=utf-8");
if($_FILES["error"]==0){
    //上传成功
    $typeArr = array("jpg","jpeg","png","gif");
    //用"."分割$file["name"]; eg:xx.png
    $type = explode(".",$file["name"]);
    if(in_array($type[count($type)-1],$typeArr)){
        //是图片格式
        //文件是上传的
        if(is_uploaded_file($file["tmp_name"])){
            $path = "../ajax3/img/".time().".".$type[count($type)-1];
            if(move_uploaded_file($file["tmp_name"],$path)){
                echo "移动成功";
                mysql_connect("localhost","root","");
                mysql_select_db("0503");
                mysql_query("set names utf8");
                $newPath = str_replace("..","http://localhost/0503",$path);
                $sql = "insert into image (id,imgPath) values (NULL ,'{$newPath}')";
                mysql_query($sql);
                if (mysql_insert_id()>0){
                    //echo "插入成功";
                    header("Location:manage.php");
                }else{
                    echo "插入失败";
                }
            }else{
                echo "移动失败";
            }
        }
    }
}