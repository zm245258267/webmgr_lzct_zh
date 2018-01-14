<?php
/**
 *	打点日志处理
 */

ini_set('date.timezone', 'Asia/Shanghai');

define('CLI_ROOT', str_replace('\\', '/', __DIR__) . '/');
define('LOG_ROOT', CLI_ROOT . '/logs/');
include 'common/db.php';
include 'common/function.php';

if(stripos(PHP_SAPI, 'cli') === false)
    $argv = array_keys($_REQUEST);

$start=time();
Main::run($argv);
echo "[".date('Y-m-d H:i:s')."]times:".(time()-$start)."s\r\n";
exit();

class Main
{
    static function run($argv)
    {
    	C(include 'common/config.php');
        if(count($argv) > 1)
            (new Autorun())->run($argv);
        else
            LogHelper::log('no argv');
    }
}

class Autorun
{
    public function run($params)
    {
        if($params && isset($params[1]))
        {
            $action = $params[1];
            $tasks  = glob(CLI_ROOT . "UserReport/{$action}/*");
            if($tasks)
            {
                foreach($tasks as $taskFile)
                {
                    require $taskFile;
                    $taskName   = basename($taskFile);
                    $className  = str_replace('.task.php', '', $taskName);
                    $className  = "\UserReport\\{$action}\\{$className}";

                    if(class_exists($className))
                        (new $className())->run();
                }
            }
        }
    }
}

class LogHelper
{
    static $filename = 'cli.log';

    static function log($data, $filename = null)
    {
        $filename = empty($filename) ? self::$filename : $filename;
        $filename = LOG_ROOT . $filename;

        if(is_array($data))
            $data = json_encode($data);

        $data = date('Y-m-d H:i:s') . ': ' . $data . PHP_EOL;

        file_put_contents($filename, $data, FILE_APPEND);
    }
}
