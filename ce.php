<?php
$new=time();
$app_id=md5(1);
$app_key=md5('594188');
$url="http://1807.96myshop.cn/mylogin";
$json=[
    'name'=>'枪神',
    'pad'=>'594188',
    'app_id'=>$app_id
];
$method = 'AES-128-CBC';//加密方法
$passwd = 'password';//加密密钥
$salt='xxxxx';
$iv=substr(md5($new.$salt),5,16);
$data=openssl_encrypt(json_encode($json),$method,$passwd,false,$iv);
//数据加密
$api_param=[];
$api_param['data']=$data;
ksort($json);
$li=http_build_query($json);
$sign_atr=$li.'&app_key='.$app_key;
//生成签名
$sign=md5($sign_atr);
//请求数据中加签名
$api_param['aign']=$sign;
//创建新的curl资源
$ch=curl_init();
//设置url和相应的选项
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($api_param));
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$res=curl_exec($ch);    //接收响应
if(curl_errno($ch)){
    var_dump(curl_errno($ch));
    var_dump(curl_error());
}
$api_arr=json_encode($data,true);
print_r($api_arr);
//parse_str($li,$datta)解密


?>