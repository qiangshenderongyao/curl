<?php
$cname=request()->input('username');
$password=request()->input('password');
$data=[
    'username'=>$cname,
    'password'=>$password
];
$url="http://1807.96myshop.cn/test/one";
$ch=curl_init();    //创建新的curl资源
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
$rs=curl_exec($ch);     //接收响应
$response=json_decode($res,true);
if($response['errno']==0){
    $response=[
      'errno'=>0,
      'msg'=>'登录成功',
      'token'=>$response['token']
    ];
}
return $response;
?>