<?php
$url="http://96lara_weixin1.cn/weixin/test1";
//创建新的curl资源
$ch=curl_init();
$file_data=[
    'name' =>'雷伊',
    'age'  =>20,
    'img'  =>new CURLFile('123.bmp')
];
//设置url和相应的选项
curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$file_data);

//抓取url并把它传递给浏览器
curl_exec($ch);
//关闭curl资源,并释放系统资源
curl_close($ch);
?>