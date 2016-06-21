<?php

define( "WB_AKEY" , '62121203' );
define( "WB_SKEY" , 'f47318365b5a65b3ac601ef52df13b53' );
define( "WB_CALLBACK_URL" , 'http://bowuting.com/weibo/callback.php' );


class Weibo{
	public $client_id;

	public $client_secret;

	public $access_token;

	function accessTokenURL()  { return 'https://api.weibo.com/oauth2/access_token'; }

	function authorizeURL()    { return 'https://api.weibo.com/oauth2/authorize'; }

	function publicURL() 			 {return 'https://api.weibo.com/2/statuses/public_timeline.json'; }

	function updateURL()     { return 'https://api.weibo.com/2/statuses/update.json';}
	function __construct($client_id, $client_secret, $access_token = NULL, $refresh_token = NULL) {
		$this->client_id = $client_id;
		$this->client_secret = $client_secret;
	}


	public function getAuthorizeURL($callbackurl){
			$params = array();
			$params['client_id'] = $this->client_id;
			$params['redirect_uri'] = $callbackurl;
			$params['response_type'] = 'code';
			$params['display'] = 'mobile';
			$params['forcelogin'] = 'true';
		return $this->authorizeURL() . "?" . http_build_query($params);
	}



	public function curlPost($url,$postData){
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

	public static function curlGet($url,$get){
    $ch = curl_init();
    $url .=  $get;
    //echo $url;
    curl_setopt($ch, CURLOPT_URL,$url);  //设置抓取的url
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设置获取的信息以文件流的形式返回，而不是直接输出。
    $data = curl_exec($ch);                     //执行命令
    curl_close($ch);
    print_r($data);
    return $data;
  }

	public function getPublicWeibo($code,$page,$len){
    $token = $this->getAccessToken($code);
    echo $token;

    $publicWeibo = $this->publicURL(). "?page=" . $page . "&access_token=" . $token['access_token'] . "&count=" . $len;

    var_dump($publicWeibo);
    $res = $this->curlGet($publicWeibo,'');
    //$res = file_get_contents($this->_publicWeibo);
    print_r(json_decode($res));
  }
	public function updateWeibo($status){


		$publicWeibo = $this->updateURL(). "?status=" . $status . "&access_token=" . "2.00usLX_D0tYeME87ba20160fLsypQE";
		var_dump($publicWeibo);

		$res = $this->curlPost($publicWeibo,'');
		print_r(json_decode($res));

	}


}





 ?>
