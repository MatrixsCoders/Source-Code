<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/9/26
 * Time: 上午9:56
 */
session_start();
?>

<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>manager</title>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">主页</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#">产品</a></li>
                <li><a href="#">关于</a></li>
                <li><a href="#">项目</a></li>
                <li class="active"><a href="#">黄图</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if(isset($_SESSION["admin"])){
                    echo "<li><a href='manage.php'>管理</a></li>";
                }
                ?>
                <li class="dropdown">
                    <?php
                    if(isset($_SESSION["user"])&& isset($_SESSION["pass"])){
                        echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">{$_SESSION["user"]}<span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\" role=\"menu\">
                        <li data-toggle=\"modal\" data-target=\"#myModal1\"><a href=\"#\">登录</a></li>
                        <li><a href=\"#\">注册</a></li>
                        <li class=\"divider\"></li>
                        <li><a href=\"javascript:signOut()\">注销</a></li>
                    </ul>";
                    }else{
                        echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">登录<span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\" role=\"menu\">
                        <li data-toggle=\"modal\" data-target=\"#myModal1\"><a href=\"#\">登录</a></li>
                        <li><a href=\"#\">注册</a></li>
                        <li class=\"divider\"></li>
                        <li><a href=\"#\">忘记密码</a></li>
                    </ul>";
                    }
                    ?>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">-->
<!--    Launch demo modal-->
<!--</button>-->

<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" action="login_api.php">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">用户名</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="用户名" name="user">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-4 control-label">密码</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="密码" name="pass">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-10">
                            <button type="submit" class="btn btn-info">登录</button>
                            <button type="button" class="btn btn-info">重置</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <form action="upload.php" enctype="multipart/form-data" method="post">
        <input type="file" name="file">
        <button type="submit" class="btn btn-success">上传</button>
    </form>
    <div class="row">
        <?php
        mysql_connect("localhost","root","");
        mysql_select_db("0503");
        mysql_query("set names utf8");
        $sql = "select * from image";
        $result = mysql_query($sql);
        while($row = mysql_fetch_assoc($result)){
            //bootstrap js插件 警告框 复制代码"X"button
            echo "<div class=\"alert col-sm-6 col-md-4 alert-dismissable\" role=\"alert\">
            <button  type=\"button\" class=\"close\" data-dismiss=\"alert\" data-id='{$row['id']}'>
              <span aria-hidden=\"true\">&times;</span>
              <span class=\"sr-only\">Close</span>
            </button>
            <div class=\"thumbnail\">
                <img src={$row['imgPath']} alt=\"...\">
                <div class=\"caption\">
                    <h3>Thumbnail label</h3>
                    <p>...</p>
                    <p><a href=\"#\" class=\"btn btn-primary\" role=\"button\">Button</a> <a href=\"#\" class=\"btn btn-default\" role=\"button\">Button</a></p>
                </div>
            </div>
        </div>";
        }
        ?>
    </div>
</div>

<script src="dist/js/jquery-1.12.1.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
    function signOut() {
        window.location.assign("http://localhost/0503/zongheTeacher/signOut.php");
    }
    $(".alert-dismissable").on("close.bs.alert",function (e) {
        e.preventDefault();
    });
    $(".alert-dismissable button").on("click",function () {
        var _this = $(this);
        $.ajax({
            url:"deleteImage.php",
            type:"post",
            data:{
                id:_this.attr("data-id")
            },
            dataType:"json",
            success:function (data) {
                //console.log(data);
                if(data.err==0){
                    _this.parent(".alert-dismissable").remove();
                } else{
                    alert("删除失败,请检查网络")
                }
            }
        })
    });

    //    function signOut() {
    //        addCookie("PHPSESSID",getCookie("PHPSESSID"),-10000)
    //    }
    //    function addcookie(name,value,expires){
    //        var date = new Date();
    //        date.setTime(date.getTime() + 24 * 3600 * 1000 * expires);
    //        document.cookie = name + "=" + value + ";expires=" + date;
    //    }
</script>
</body>
</html>
