<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "game_server".
 *
 * @property integer $serverId
 * @property string $serverName
 * @property integer $targetId
 * @property integer $login_server
 * @property string $groupId
 * @property string $spIdSet
 * @property string $openTime
 * @property integer $socketPort
 * @property string $serverHost
 * @property string $serverIp
 * @property integer $serverPort
 * @property string $charDbIp
 * @property string $charDbName
 * @property integer $charDbPort
 * @property string $eventDbIp
 * @property string $eventDbName
 * @property integer $eventDbPort
 * @property integer $onlineMax
 * @property integer $chargeSw
 * @property integer $serverSw
 * @property integer $power
 * @property integer $status
 * @property string $statusTips
 * @property integer $newday
 * @property integer $hotday
 * @property integer $cversion_higher
 * @property integer $cversion_lower
 */
class GameServer extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_server';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serverId', 'serverName', 'serverIp'], 'required'],
            [['serverId', 'targetId', 'login_server', 'socketPort', 'serverPort', 'charDbPort', 'eventDbPort', 'onlineMax', 'chargeSw', 'serverSw', 'power', 'status', 'newday', 'hotday', 'cversion_higher', 'cversion_lower'], 'integer'],
            [['openTime'], 'safe'],
            [['serverName', 'charDbName', 'eventDbName', 'statusTips'], 'string', 'max' => 60],
            [['groupId'], 'string', 'max' => 200],
            [['spIdSet'], 'string', 'max' => 1024],
            [['serverHost', 'serverIp', 'charDbIp', 'eventDbIp'], 'string', 'max' => 255],
            [['serverName'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'serverId' => '服务器ID',
            'serverName' => '服务器名',
            'targetId' => '目标ID',
            'login_server' => '登陆服务器',
            'groupId' => '分组ID',
            'spIdSet' => '渠道集',
            'openTime' => '开服时间',
            'socketPort' => 'SOCKET端口',
            'serverHost' => '服务器HOST',
            'serverIp' => '服务器IP',
            'serverPort' => '服务器端口',
            'charDbIp' => '角色库IP',
            'charDbName' => '角色库名',
            'charDbPort' => '角色库端口',
            'eventDbIp' => '行为日志库IP',
            'eventDbName' => '行为日志库名',
            'eventDbPort' => '行为日志库端口',
            'onlineMax' => '在线上限',
            'chargeSw' => '充值开关',
            'serverSw' => '服务器开关',
            'power' => '开关服状态(KILL进程)',
            'status' => '状态',
            'statusTips' => '状态提示语',
            'newday' => '新服状态天数',
            'hotday' => '火爆状态天数',
            'cversion_higher' => '最大CPP版本',
            'cversion_lower' => '最小CPP版本',
        ];
    }

  /**
     * 返回数据库字段信息，仅在生成CRUD时使用，如不需要生成CRUD，请注释或删除该getTableColumnInfo()代码
     * COLUMN_COMMENT可用key如下:
     * label - 显示的label
     * inputType 控件类型, 暂时只支持text,hidden  // select,checkbox,radio,file,password,
     * isEdit   是否允许编辑，如果允许编辑将在添加和修改时输入
     * isSearch 是否允许搜索
     * isDisplay 是否在列表中显示
     * isOrder 是否排序
     * udc - udc code，inputtype为select,checkbox,radio三个值时用到。
     * 特别字段：
     * id：主键。必须含有主键，统一都是id
     * create_date: 创建时间。生成的代码自动赋值
     * update_date: 修改时间。生成的代码自动赋值
     */
    public function getTableColumnInfo(){
        return array(
        'serverId' => array(
                        'name' => 'serverId',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '服务器ID',
//                         'dbType' => "int(10) unsigned",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('serverId'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'serverName' => array(
                        'name' => 'serverName',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '服务器名',
//                         'dbType' => "varchar(60)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '60',
                        'scale' => '',
                        'size' => '60',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('serverName'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'targetId' => array(
                        'name' => 'targetId',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '目标ID',
//                         'dbType' => "int(10) unsigned",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('targetId'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'login_server' => array(
                        'name' => 'login_server',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '登陆服务器',
//                         'dbType' => "int(10) unsigned",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('login_server'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'groupId' => array(
                        'name' => 'groupId',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '分组ID',
//                         'dbType' => "char(200)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '200',
                        'scale' => '',
                        'size' => '200',
                        'type' => 'char',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('groupId'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'spIdSet' => array(
                        'name' => 'spIdSet',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '渠道集',
//                         'dbType' => "varchar(1024)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '1024',
                        'scale' => '',
                        'size' => '1024',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('spIdSet'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'openTime' => array(
                        'name' => 'openTime',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '开服时间',
//                         'dbType' => "timestamp",
                        'defaultValue' => '0000-00-00 00:00:00',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'timestamp',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('openTime'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'socketPort' => array(
                        'name' => 'socketPort',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => 'SOCKET端口',
//                         'dbType' => "int(10) unsigned",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('socketPort'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'serverHost' => array(
                        'name' => 'serverHost',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '服务器HOST',
//                         'dbType' => "char(255)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '255',
                        'scale' => '',
                        'size' => '255',
                        'type' => 'char',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('serverHost'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'serverIp' => array(
                        'name' => 'serverIp',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '服务器IP',
//                         'dbType' => "char(255)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '255',
                        'scale' => '',
                        'size' => '255',
                        'type' => 'char',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('serverIp'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'serverPort' => array(
                        'name' => 'serverPort',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '服务器端口',
//                         'dbType' => "int(11)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '11',
                        'scale' => '',
                        'size' => '11',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('serverPort'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'charDbIp' => array(
                        'name' => 'charDbIp',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '角色库IP',
//                         'dbType' => "char(255)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '255',
                        'scale' => '',
                        'size' => '255',
                        'type' => 'char',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('charDbIp'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'charDbName' => array(
                        'name' => 'charDbName',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '角色库名',
//                         'dbType' => "char(60)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '60',
                        'scale' => '',
                        'size' => '60',
                        'type' => 'char',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('charDbName'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'charDbPort' => array(
                        'name' => 'charDbPort',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '角色库端口',
//                         'dbType' => "int(11)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '11',
                        'scale' => '',
                        'size' => '11',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('charDbPort'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'eventDbIp' => array(
                        'name' => 'eventDbIp',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '行为日志库IP',
//                         'dbType' => "char(255)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '255',
                        'scale' => '',
                        'size' => '255',
                        'type' => 'char',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('eventDbIp'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'eventDbName' => array(
                        'name' => 'eventDbName',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '行为日志库名',
//                         'dbType' => "char(60)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '60',
                        'scale' => '',
                        'size' => '60',
                        'type' => 'char',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('eventDbName'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'eventDbPort' => array(
                        'name' => 'eventDbPort',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '行为日志库端口',
//                         'dbType' => "int(11)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '11',
                        'scale' => '',
                        'size' => '11',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('eventDbPort'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'onlineMax' => array(
                        'name' => 'onlineMax',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '在线上限',
//                         'dbType' => "int(11)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '11',
                        'scale' => '',
                        'size' => '11',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('onlineMax'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'chargeSw' => array(
                        'name' => 'chargeSw',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '充值开关',
//                         'dbType' => "tinyint(4)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '4',
                        'scale' => '',
                        'size' => '4',
                        'type' => 'smallint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('chargeSw'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'serverSw' => array(
                        'name' => 'serverSw',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '服务器开关',
//                         'dbType' => "tinyint(4)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '4',
                        'scale' => '',
                        'size' => '4',
                        'type' => 'smallint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('serverSw'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'power' => array(
                        'name' => 'power',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '开关服状态(KILL进程)',
//                         'dbType' => "tinyint(3) unsigned",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '3',
                        'scale' => '',
                        'size' => '3',
                        'type' => 'smallint',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('power'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'status' => array(
                        'name' => 'status',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '状态',
//                         'dbType' => "tinyint(4)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '4',
                        'scale' => '',
                        'size' => '4',
                        'type' => 'smallint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('status'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'statusTips' => array(
                        'name' => 'statusTips',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '状态提示语',
//                         'dbType' => "varchar(60)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '60',
                        'scale' => '',
                        'size' => '60',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('statusTips'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'newday' => array(
                        'name' => 'newday',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '新服状态天数',
//                         'dbType' => "tinyint(4)",
                        'defaultValue' => '2',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '4',
                        'scale' => '',
                        'size' => '4',
                        'type' => 'smallint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('newday'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'hotday' => array(
                        'name' => 'hotday',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '火爆状态天数',
//                         'dbType' => "tinyint(4)",
                        'defaultValue' => '3',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '4',
                        'scale' => '',
                        'size' => '4',
                        'type' => 'smallint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('hotday'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'cversion_higher' => array(
                        'name' => 'cversion_higher',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '最大CPP版本',
//                         'dbType' => "int(11)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '11',
                        'scale' => '',
                        'size' => '11',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('cversion_higher'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'cversion_lower' => array(
                        'name' => 'cversion_lower',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '最小CPP版本',
//                         'dbType' => "int(11)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '11',
                        'scale' => '',
                        'size' => '11',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('cversion_lower'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		        );
        
    }
 
}
