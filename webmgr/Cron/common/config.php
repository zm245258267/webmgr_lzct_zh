<?php
/**
 * 计划任务相关配置文件
 */
return [ 
		'YUNYINGEND_DB' => [ 
				'DSN' => 'mysql:host=localhost;port=3306;dbname=lzct_yunyingend',
				'PWD' => '511c0fcabff6bbdb',
				'USER' => 'root' 
		],
		'GAME_DB' => [ 
				'DSN' => 'mysql:host=localhost;port=3306;dbname=lzct_gamedb',
				'PWD' => '511c0fcabff6bbdb',
				'USER' => 'root' 
		],
		'LOG_DB' => [ 
				'DSN' => 'mysql:host=localhost;port=3306;dbname=lzct_gamelog',
				'PWD' => '511c0fcabff6bbdb',
				'USER' => 'root' 
		],
		'PAY_DB' => [ 
				'DSN' => 'mysql:host=localhost;port=3306;dbname=lzct_gamepay',
				'PWD' => '511c0fcabff6bbdb',
				'USER' => 'root' 
		],
        
        /**
         * 行为日志文件目录
         */
		'EVENT_LOG_PATH'=>'/data/web/gamelog/',
        
        /**
         * 打点日志文件目录
         */
		'USER_REPORT_LOG_PATH'=>'/data/web/user-report-log/',
];

