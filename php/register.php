<?php
/**
 * Created by PhpStorm.
 * User: vvv
 * Date: 2017/3/18
 * Time: 14:18
 */
require 'smtp.class.php';             //导入smtp邮件类
//验证是否为空
if(!(empty($_GET["raccount"])&&empty($_GET["rpassword"]))) {
    $raccount = $_GET["raccount"];          //账号
    $rpassword = md5($_GET["rpassword"]);   //得到用md5加密的密码
    $email = $_GET['email'];                //邮件
    $regtime = time();                      //当前时间
    $token = md5($raccount.$_GET['rpassword'].$regtime);        //链接账号密码时间，md5加密得到token
    $token_exptime = time()+60*60*24;   //过期时间24小时
    $conn = new mysqli('localhost', 'root', 'zht1741105', 'login');
    if (mysqli_connect_errno()) {
        echo "数据库连接失败";
    }
    //插入数据
    $str = "INSERT INTO user(account,password,email,token,token_exptime,regtime) VALUES('$raccount','$rpassword','$email','$token','$token_exptime','$regtime');";
    $result = $conn->query($str);
    /*if($result){
        echo "1";
    }else{
        echo "0";
    }*/
    if ($result) {
        $smtpserver     = "smtp.163.com";        //SMTP服务器
        $smtpserverport = 25;                    //SMTP服务器端口
        $smtpusermail   = "15527243273@163.com"; //SMTP服务器的用户邮箱
        $smtpemailto    = $email;
        $smtpuser       = "15527243273@163.com"; //SMTP服务器的用户帐号
        $smtppass       = "a625398609";          //SMTP服务器的用户密码
        $mailsubject    = "注册激活";            //邮件主题
        $mailsubject    = "=?UTF-8?B?" . base64_encode($mailsubject) . "?=";    //防止乱码
        $mailbody       = "亲爱的".$raccount.":<br/>感谢在我站注册了新账号.<br/>请点击链接激活您的账号<br/>
        <a href='http://localhost:63342/Login/php/active.php?verify=".$token."' target='_blank'>
        http://localhost:80/Login/php/active.php?verify=".$token."</a><br/>     
        如果以上链接无法点击，请在浏览器地址栏中复制访问，该链接24小时有效。";  //邮件内容,点击进入active.php处理
        $mailtype       = "HTML";                //邮件格式
        $smtp           = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp->debug    = FALSE;                 //是否显示发送的调试信息
        $rs = $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
        if($rs==1) {
            echo "注册成功！请尽快激活<a href='../html/login.html' target='_blank'>返回</a>登录页面";
        }
    }else {
        echo "注册失败！<a href='../html/register.html'>返回</a>";
    }
}
?>