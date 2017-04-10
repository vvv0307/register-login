<?php
/**
 * Created by PhpStorm.
 * User: vvv
 * Date: 2017/3/18
 * Time: 14:10
 */
/*$str = "SELECT *FROM user WHERE id = '1';";*/
//开启session 得到验证码，熊前端获取输入的账号密码验证码
session_start();
$account = $_GET["account"];
$password = $_GET["password"];
$code = $_GET["vcode"];
$yzm = $_SESSION['code'];

/*if($code == $yzm){
    echo "0";
}else{
    echo "1";
}*/
/*echo $_SESSION['code'];
echo gettype($_SESSION['code']);*/
if($code != $yzm){             //验证码不同
    echo "<script>alert('验证码错误！重新输入！');parent.location.href='../html/login.html';</script>";
}else {
    $conn = new mysqli('localhost', 'root', 'zht1741105', 'login');
    if (mysqli_connect_errno()) {
        echo "数据库连接失败";
    }
    #利用账号密码查询，有结果说明账号密码正确
    $str = "SELECT * FROM user WHERE account = '$account' AND password = '$password';";
    $rs = $conn->query($str);
    $row = $rs->fetch_array();
    if(!$row) {
        echo "用户名或密码错误，请<a href='../html/login.html'>返回</a>重新登陆!";
    }else if($row['status']==0){
        echo "账号未激活，请激活后<a href='../html/login.html'>登录</a>";
    }else {
        header("location:http://localhost/index.php");           //登陆成功挑战到默认页面；
        exit;
    }
    $conn->close();
}
session_destroy();  //销毁session
?>
