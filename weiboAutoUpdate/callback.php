<?php

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

	$str = "现在是：" . date('h',time()) . "点" . date('i',time()) . "啦！";
var_dump(date('i',time()));

	if (date('i',time()) == '25') {
			updateWeibo($str);
	}




?>
