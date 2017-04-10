<?php
/**
 * Created by PhpStorm.
 * User: vvv
 * Date: 2017/3/20
 * Time: 8:08
 */

    $r = $_GET['raccount'];    //获取账号
    $conn = new mysqli('localhost','root','zht1741105','login');
    $sql = "SELECT * FROM user WHERE account = '".$r."';";  //根据账号查询
    $rs = $conn->query($sql);
    $row = $rs->fetch_assoc();
    /*$row = $rs->fetch_assoc();
    echo $row['password'];*/
    if($row){
        echo '1';
    }else{
        echo '0';
    }
    $conn->close();


?>