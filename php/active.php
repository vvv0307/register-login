<?php
#点击邮件链接后提交到active.php处理
$verify = stripslashes(trim($_GET['verify']));                                 //获取verify值
$nowtime = time();                                                             //获取时间
$conn = new mysqli('localhost', 'root', 'zht1741105', 'login');                //连接数据库
$rs = $conn->query("select id,token_exptime from user where status='0' and `token`='$verify';"); //查询id，有效时间
$row = $rs->fetch_array();                                  //获取查询结果
if($row){
	if($nowtime>$row['token_exptime']){ //超过有效时间
		$msg = '您的激活有效期已过，请登录您的帐号重新发送激活邮件.';
	}else{
		$rs = $conn->query("update user set status=1 where id=".$row['id']);    //未超过有效时间，修改激活状态为1（可登陆)
		if($rs){
            $msg = '激活成功！';
        }
	}
}else{
	$msg = 'error.';	
}

echo $msg;
$conn->close();
?>
