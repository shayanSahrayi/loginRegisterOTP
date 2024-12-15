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
 
 if($data){
    $query="UPDATE users SET otp=:otp WHERE (mobile=:key OR email=:key)";
    $stms=$pdo->prepare($query);
    // $stms->execute($otp,$phone,$phone);
    $stms->bindvalue(':otp',$otp);
    $stms->bindvalue(':key',$phone);
    $stms->execute();
    
 }
}