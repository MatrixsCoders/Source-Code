<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/9/26
 * Time: 上午10:48
 */
session_start();

setcookie(session_name(),session_id(),1000,"/");
header("Location:index.php");