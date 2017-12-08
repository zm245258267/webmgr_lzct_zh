<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "game_users".
 *
 * @property integer $userid
 * @property string $account
 * @property integer $serverid
 * @property string $createtime
 * @property string $createplatform
 * @property string $createspid
 * @property string $createsbid
 * @property string $macaddr
 * @property string $logintime
 * @property string $logouttime
 * @property string $loginplatform
 * @property integer $loginserverid
 * @property integer $is_cross
 * @property string $dayback
 */
class GameUsers extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serverid', 'loginserverid', 'is_cross', 'dayback'], 'integer'],
            [['createtime', 'createplatform', 'logintime', 'logouttime'], 'required'],
            [['createtime', 'logintime', 'logouttime'], 'safe'],
            [['account', 'macaddr'], 'string', 'max' => 64],
            [['createplatform'], 'string', 'max' => 16],
            [['createspid', 'createsbid', 'loginplatform'], 'string', 'max' => 8],
            [['account'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'Userid',
            'account' => '账号',
            'serverid' => '服务器ID',
            'createtime' => '注册时间',
            'createplatform' => '注册平台（设备型号）',
            'createspid' => '注册渠道ID',
            'createsbid' => '注册子渠道ID',
            'macaddr' => 'mac',
            'logintime' => '登陆时间',
            'logouttime' => '登出时间',
            'loginplatform' => '登陆平台',
            'loginserverid' => '登陆服务器ID',
            'is_cross' => '1跨服登陆',
            'dayback' => '留存',
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
        'userid' => array(
                        'name' => 'userid',
                        'allowNull' => false,
//                         'autoIncrement' => true,
//                         'comment' => '',
//                         'dbType' => "int(10)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('userid'),
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
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'serverid' => array(
                        'name' => 'serverid',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '服务器ID',
//                         'dbType' => "int(10)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('serverid'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'createtime' => array(
                        'name' => 'createtime',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '注册时间',
//                         'dbType' => "datetime",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'datetime',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('createtime'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'createplatform' => array(
                        'name' => 'createplatform',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '注册平台（设备型号）',
//                         'dbType' => "varchar(16)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '16',
                        'scale' => '',
                        'size' => '16',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('createplatform'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'createspid' => array(
                        'name' => 'createspid',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '注册渠道ID',
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
                        'label'=>$this->getAttributeLabel('createspid'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'createsbid' => array(
                        'name' => 'createsbid',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '注册子渠道ID',
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
                        'label'=>$this->getAttributeLabel('createsbid'),
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
//                         'comment' => 'mac',
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
		'logintime' => array(
                        'name' => 'logintime',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '登陆时间',
//                         'dbType' => "datetime",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'datetime',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('logintime'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'logouttime' => array(
                        'name' => 'logouttime',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '登出时间',
//                         'dbType' => "datetime",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'datetime',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('logouttime'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'loginplatform' => array(
                        'name' => 'loginplatform',
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
                        'label'=>$this->getAttributeLabel('loginplatform'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'loginserverid' => array(
                        'name' => 'loginserverid',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '登陆服务器ID',
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
                        'label'=>$this->getAttributeLabel('loginserverid'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'is_cross' => array(
                        'name' => 'is_cross',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '1跨服登陆',
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
                        'label'=>$this->getAttributeLabel('is_cross'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'dayback' => array(
                        'name' => 'dayback',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '留存',
//                         'dbType' => "bigint(20) unsigned",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '20',
                        'scale' => '',
                        'size' => '20',
                        'type' => 'bigint',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('dayback'),
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
