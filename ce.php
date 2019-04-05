<?php
$url="http://96lara_weixin1.cn/weixin/test1";
$data=[
    'name'=>'枪神',
    'age'=>20
];
$li=http_build_query($data);
print_r($li);
$method = 'AES-128-CBC';//加密方法
$passwd = 'password';//加密密钥
$salt='xxxxx';

?>