<?php
$new=time();
$su=[
    'name'=>'雷伊',
    'age'=>20
];
$url = "http://96lara_weixin1.cn/weixin/test3?t=".$new;
$method = 'AES-128-CBC';//加密方法
$passwd = 'password';//加密密钥
$salt='xxxxx';
$iv=substr(md5($new.$salt),5,16);
$json=json_encode($su);
$data=openssl_encrypt($json,$method,$passwd,OPENSSL_RAW_DATA,$iv);
$post_data=base64_encode($data);
//计算签名
$signature='';
$key_res=openssl_pkey_get_private(file_get_contents("priv.key"));
openssl_sign($post_data,$signature,$key_res,OPENSSL_ALGO_SHA256);
//释放资源
openssl_free_key($key_res);
$sign=base64_encode($signature);
//向服务端发送数据
$ch=curl_init();
//设置url和相应的选项
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,['data'=>$post_data,'sign'=>$sign]);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_HEADER,0);
$res=curl_exec($ch);    //接收响应
//var_dump($res);die;
$response=json_decode($res,true);
//var_dump($response);die;
$iv2=substr(md5($response['t'].$salt),5,16);
//var_dump($iv2);die;
//解密响应数据
$enc_data=openssl_decrypt(base64_decode($response['data']),$method,$passwd,OPENSSL_RAW_DATA,$iv2);
var_dump($enc_data);
?>