<?php
require_once("../config/loader.php");

if(isset($_POST['send_sms'])){  
 
    // 278887
    // $url="";
//  file_get_contents();
// ini_set("soap.wsdl_cache_enabled","0");
// $sms = new SoapClient("http://api.payamak-panel.com/post/Send.asmx?wsdl",array("encoding"=>"UTF-8"));
// $data = array(
//     "username"=>"09186609535",
//     "password"=>"!A7TL",
//     "text"=>array("shayan",rand(11234,99999)),
//     "to"=>"",
//     "bodyId"=>278887);
// $send_Result = $sms->SendByBaseNumber($data)->SendByBaseNumberResult;
// echo $send_Result;
$otp=rand(10125,99877);
$phone=$_POST['phone'];
$url="http://api.payamak-panel.com/post/Send.asmx/SendByBaseNumber2?username=09186609535&password=!A7TL&text=test;$otp&to=$phone&bodyId=278887";
$data=file_get_contents($url);
 $data=1;
 if($data){
    $query="UPDATE users SET otp=:otp WHERE (mobile=:key OR email=:key)";
    $stms=$pdo->prepare($query);
    // $stms->execute($otp,$phone,$phone);
    $stms->bindvalue(':otp',$otp);
    $stms->bindvalue(':key',$phone);
    $stms->execute();
    session_start();
    $session['username']=$phone;
    header("Location:../otp.php?send_success");
    die();
 }
 else{
    header("Location: ../otp.php?send_faild");
    die();
 }
}
if(isset($_POST['check_otp'])){
    $query="SELECT * FROM users WHERE (mobile=:key OR email=:key) AND OTP=:otp LIMIT 1";
    $stmt=$pdo->prepare($query);
    $stmt->bindvalue(':key',$_POST['phone']);
    $stmt->bindvalue(":otp",$_POST['otp']);
    $stmt->execute();
    $result=$stmt->fetch();
    if($result){
        var_dump($result);
    }
    else{
        echo 'has err';
    }
}