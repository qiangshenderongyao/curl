<?php
/*$dada=[
    'name' => '赤耀'
];
$priv_key='123456';   //私钥密码
$number=100;          //有效时长
$cerpath="./priv.key";//生成证书路径
$pubpath="./pub.pem"; //生成文件路径
//生成证书
$privkey=openssl_pkey_new();
$csr=openssl_csr_new($data,$privkey);
$sscert=openssl_csr_sign($csr,null,$privkey,$number);
openssl_x509_export($sscert,$priv_key);*/
$url = "http://96lara_weixin1.cn/weixin/test2";
$ch=curl_init();    //创建新的curl资源
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_HEADER,0);
$rs=curl_exec($ch);     //接收响应
$response=json_decode($rs,true);
var_dump($response);

$pubKey = file_get_contents("pub.pem");
//$pubKey = wordwrap($pubKey, 64, "\n", true) ;
//echo $pubKey;die;
$res = openssl_get_publickey($pubKey);
//var_dump($res);die;
($res) or die('您使用的公钥格式错误，请检查RSA公钥配置');

$result = (openssl_verify(json_encode($response['data']), base64_decode($response['sign']), $res, OPENSSL_ALGO_SHA256)===1);
openssl_free_key($res);
var_dump($result) ;
?>