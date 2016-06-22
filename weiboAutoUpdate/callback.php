<?php

<<<<<<< HEAD
function curlGET($url,$header=array()){
    //初始化
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL,$url);
    //设置头文件的信息作为数据流输出
    //curl_setopt($curl, CURLOPT_HEADER, 1);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		//设置header
		curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
    //执行命令
    return  curl_exec($curl);
    //关闭URL请求
    curl_close($curl);
    //显示获得的数据
  	//return $data;
}
=======
>>>>>>> 53c65ba32c0501cce372b4060619f17ef36816d2
function curlPost($url,$postData){

	$ch = curl_init();
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_POST,true);
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$postData);

	$response = curl_exec($ch);

	if (curl_errno($ch)) {
		return false;
	}

	curl_close($ch);
	return $response;
}

function updateWeibo($status){

	$publicWeibo = 'https://api.weibo.com/2/statuses/update.json'. "?status=" . $status . "&access_token=" . "2.00usLX_D0tYeME87ba20160fLsypQE";

	var_dump($publicWeibo);

	$res = curlPost($publicWeibo,'');
	print_r(json_decode($res));

}
<<<<<<< HEAD
$url = "http://api.yeelink.net/v1.0/device/349024/sensor/390744/datapoint/";
$apiKey[] = "U-ApiKey: a1c88bbe78cd1b9d25da4ec25e650ff4";

	while(1){
	$str = "现在是：" . date('h',time()) . "点" . date('i',time()) ."啦！";

	 $temp = curlGet($url,$apiKey); //发送请求 获取温度
	 $temp = json_decode($temp);    //解析json
		$str .= "寝室的温度是：" . $temp->value . "摄氏度。"; //拼接

	if ((date('i',time()) == '42') && (date('s',time()) == '50')){
			updateWeibo($str);
			sleep(20);
	}

     }
=======

	$str = "现在是：" . date('h',time()) . "点" . date('i',time()) . "啦！";
var_dump(date('i',time()));

	if (date('i',time()) == '25') {
			updateWeibo($str);
	}


>>>>>>> 53c65ba32c0501cce372b4060619f17ef36816d2


?>
