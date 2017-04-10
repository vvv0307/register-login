<?php
/**
 * Created by PhpStorm.
 * User: vvv
 * Date: 2017/4/1
 * Time: 6:17
 */
session_start();                           //开启session
$vcode = $_SESSION['code'];                //得到存在session中的验证码
$v = $_GET['vcode'];
if($vcode != $v){
    echo "1";
}else{
    echo "0";
}
session_destroy()
?>
