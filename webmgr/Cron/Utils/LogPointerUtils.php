<?php 
/**
 * 日志文件扫描指针类
 */
namespace Cron\Utils;

class LogPointerUtils extends baseUtils{
    /**
     * 指针目录
     * @var string
     */
    protected $pointerDir;
    
    /**
     * 指针文件名
     * @var string
     */
    protected $pointerFileName;
    
    /**
     * 指针文件扩展名
     * @var string
     */
    protected $pointerExt='.point';
    
    /**
     * 延期时长
     * 默认向前减600秒开始扫瞄
     * @var integer
     */
    protected $delaySecond=600;
    
    /**
     * 文件锁
     * @var string
     */
    protected $fileLock=true;
    
    /**
     * 文件句柄
     * @var resource
     */
    protected $fileHandle;
    
    /**
     * 文件写入模式
     * @var string
     */
    protected $fileMode='w';
    
    /**
     * 初始化配置
     * @param array $config
     */
    public function __construct(array $config=[]){
        parent::__construct($config);
        foreach ($config as $key=>$val){
            $this->$key=$val;
        }
        
        /**
         * 配置检查
         */
        if ($this->pointerDir=='' || $this->pointerFileName==''){
            throw new \Exception("未指定指针目录 和 指针文件名");
        }
        
        $this->pointerDir=trim($this->pointerDir,'/').'/';
        $this->pointerFileName=trim($this->pointerFileName,'/');
        
        $handle=@fopen($this->pointerDir.$this->pointerFileName, $this->fileMode);
        if ($handle){
            flock($handle, LOCK_EX);
            $this->fileHandle=$handle;
        }else{
            throw new \Exception("{$this->pointerDir} 目录 没有读写权限");
        }
    }
    
    public function __set($name,$val){
        return null;
    }
    
    public function __get($name){
        return null;
    }
    
}