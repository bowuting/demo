<?php
return array(
	//'配置项'=>'配置值'

	'DB_TYPE' => 'mysql', // 数据库类型
    'DB_HOST'=>'115.159.62.168',//设置主机
    'DB_NAME'=>'shop',//设置数据库名
    'DB_USER'=>'root',  //设置用户名
    'DB_PWD'=>'zc5210',   //设置密码
    'DB_PORT'=>'3306',   //设置端口号
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_PREFIX'=>'x_',  //设置表前缀


		    //七牛atart
		    'UPLOAD_SITEIMG_QINIU' => array (
		        'maxSize' => 5 * 1024 * 1024,//文件大小
		        'rootPath' => './',
		        'saveName' => array ('uniqid', ''),
		        'driver' => 'Qiniu',
		        'driverConfig' => array (
		            'secretKey' => 'mS4Zp_UCgNWeqBme3zscUVPlbift44GNsSinMQBm',
		            'accessKey' => '3qi3glFmW7EAyOntSc6E2TXF2pNxHw4QMT_8VDik',
		            'domain' => 'file.bowuting.com',
		            'bucket' => 'qingdao',
		        )),
		    //七牛end


























    // 设置默认的模板主题 theme
    'DEFAULT_THEME'    =>'default',
    'TMPL_DETECT_THEME' => true,  // 自动侦测模板主题
    'THEME_LIST'   => 'default,semantic,wx', //可用主题列表

);
