<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "game_login_log".
 *
 * @property integer $server
 * @property string $account
 * @property string $spid
 * @property string $sbid
 * @property string $charname
 * @property string $platform
 * @property string $ipaddr
 * @property string $macaddr
 * @property string $cversion
 * @property integer $createserver
 * @property string $logdate
 */
class GameLoginLog extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_login_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['server'], 'required'],
            [['server', 'createserver'], 'integer'],
            [['logdate'], 'safe'],
            [['account', 'charname', 'macaddr'], 'string', 'max' => 64],
            [['spid', 'sbid', 'platform'], 'string', 'max' => 8],
            [['ipaddr', 'cversion'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'server' => '服务器ID',
            'account' => '账号',
            'spid' => '渠道ID',
            'sbid' => '子渠道ID',
            'charname' => '角色名',
            'platform' => '登陆平台',
            'ipaddr' => 'IP',
            'macaddr' => 'MAC',
            'cversion' => '客户端版',
            'createserver' => '注册服务器',
            'logdate' => '日志时间',
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
        'server' => array(
                        'name' => 'server',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '服务器ID',
//                         'dbType' => "int(11)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'integer',
                        'precision' => '11',
                        'scale' => '',
                        'size' => '11',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('server'),
                        'inputType' => 'hidden',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'account' => array(
                        'name' => 'account',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '账号',
//                         'dbType' => "varchar(64)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '64',
                        'scale' => '',
                        'size' => '64',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('account'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'spid' => array(
                        'name' => 'spid',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '渠道ID',
//                         'dbType' => "varchar(8)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '8',
                        'scale' => '',
                        'size' => '8',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('spid'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'sbid' => array(
                        'name' => 'sbid',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '子渠道ID',
//                         'dbType' => "varchar(8)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '8',
                        'scale' => '',
                        'size' => '8',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('sbid'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'charname' => array(
                        'name' => 'charname',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '角色名',
//                         'dbType' => "varchar(64)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '64',
                        'scale' => '',
                        'size' => '64',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('charname'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'platform' => array(
                        'name' => 'platform',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '登陆平台',
//                         'dbType' => "varchar(8)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '8',
                        'scale' => '',
                        'size' => '8',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('platform'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'ipaddr' => array(
                        'name' => 'ipaddr',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => 'IP',
//                         'dbType' => "varchar(32)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '32',
                        'scale' => '',
                        'size' => '32',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('ipaddr'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'macaddr' => array(
                        'name' => 'macaddr',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => 'MAC',
//                         'dbType' => "varchar(64)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '64',
                        'scale' => '',
                        'size' => '64',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('macaddr'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'cversion' => array(
                        'name' => 'cversion',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '客户端版',
//                         'dbType' => "varchar(32)",
                        'defaultValue' => '1.0.0.0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '32',
                        'scale' => '',
                        'size' => '32',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('cversion'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'createserver' => array(
                        'name' => 'createserver',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '注册服务器',
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
                        'label'=>$this->getAttributeLabel('createserver'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'logdate' => array(
                        'name' => 'logdate',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '日志时间',
//                         'dbType' => "timestamp",
                        'defaultValue' => 'CURRENT_TIMESTAMP',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'timestamp',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('logdate'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		        );
        
    }
 
}
