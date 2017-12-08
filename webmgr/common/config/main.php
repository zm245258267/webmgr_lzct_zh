<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Asia/Shanghai',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@runtime/cache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=lzct_yunyingend',
            'username' => 'root',
            'password' => '511c0fcabff6bbdb',
            'charset' => 'utf8',
        ],
       'char_db' => [
              'class' => 'yii\db\Connection',
              'dsn' => 'mysql:host=localhost;dbname=lzct_gamedb',
              'username' => 'root',
              'password' => '511c0fcabff6bbdb',
              'charset' => 'utf8',
          ], 
   		'log_db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=lzct_gamelog',
                'username' => 'root',
                'password' => '511c0fcabff6bbdb',
                'charset' => 'utf8',
           ],
        'query' => 'yii\db\Query',
        
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
        ],
    ],
    
];
