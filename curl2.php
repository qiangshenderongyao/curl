<?php
$new=time();
$url="http://96lara_weixin1.cn/weixin/test1?t=".$new;
$su=[
    'name'=>'雷伊',
    'age'=>20
];

$method = 'AES-128-CBC';//加密方法
$passwd = 'password';//加密密钥
$salt='xxxxx';
//$iv=mt_rand(11111,99999).'abcdfghjklq';//初始化向量
$iv=substr(md5($new.$salt),5,16);
$json=json_encode($su);
$data=openssl_encrypt($json,$method,$passwd,OPENSSL_RAW_DATA,$iv);
$post_data=base64_encode($data);
//var_dump($post_data);
//创建新的curl资源
$ch=curl_init();
//设置url和相应的选项
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,['data'=>$post_data]);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_HEADER,0);
$res=curl_exec($ch);    //接收响应
//var_dump($res);die;
$response=json_decode($res,true);
//var_dump($response);die;
//解密
$iv2=substr(md5($response['t'].$salt),5,16);
//加密响应数据
$enc_data=openssl_decrypt(base64_decode($response['data']),$method,$passwd,OPENSSL_RAW_DATA,$iv2);
var_dump($enc_data);
?>