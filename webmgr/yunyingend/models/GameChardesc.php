<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "game_chardesc".
 *
 * @property integer $charid
 * @property integer $userid
 * @property string $account
 * @property string $charname
 * @property integer $serverid
 * @property integer $charlevel
 * @property integer $gold
 * @property integer $guildid
 * @property integer $charstate
 * @property string $createtime
 * @property string $updatetime
 * @property string $loginip
 * @property integer $viplv
 * @property integer $vipexp
 * @property string $firstrechargetime
 * @property integer $firstrechargelevel
 * @property integer $totalrecharge
 */
class GameChardesc extends \backend\models\BaseModel
{
	public static $dsn;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_chardesc';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        $db=Yii::$app->get('char_db');
        if (self::$dsn){
        	$db->dsn=self::$dsn;
        }
        return $db;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['charid', 'userid', 'account', 'charname', 'serverid', 'createtime'], 'required'],
            [['charid', 'userid', 'serverid', 'charlevel', 'gold', 'guildid', 'guildstatus', 'charstate', 'viplv', 'vipexp', 'firstrechargelevel', 'totalrecharge'], 'integer'],
            [['createtime', 'updatetime', 'firstrechargetime'], 'safe'],
            [['account'], 'string', 'max' => 64],
            [['charname', 'loginip'], 'string', 'max' => 48],
            [['charname'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'charid' => '角色ID',
            'userid' => '用户ID',
            'account' => '账号',
            'charname' => '角色名',
            'spid' => '渠道ID',
            'serverid' => '服务器ID',
            'charlevel' => '领主等级',
            'gold' => '金币数量',
            'guildid' => '主线任务ID',
            'guildstatus' => '主线任务状态',
            'charstate' => '角色状态',
            'createtime' => '创建时间',
            'updatetime' => '最后更新时间',
            'loginip' => '登陆IP',
            'viplv' => 'VIP等级',
            'vipexp' => 'VIP经验',
            'castlelevel' => '城堡等级',
            'countryid' => '国家ID',
            'firstrechargetime' => '首充时间',
            'firstrechargelevel' => '首充等级',
            'totalrecharge' => '总充值金额',
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
        'charid' => array(
                        'name' => 'charid',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '角色ID',
//                         'dbType' => "bigint(20)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'integer',
                        'precision' => '20',
                        'scale' => '',
                        'size' => '20',
                        'type' => 'bigint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('charid'),
                        'inputType' => 'hidden',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'userid' => array(
                        'name' => 'userid',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '用户ID',
//                         'dbType' => "bigint(10)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'bigint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('userid'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
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
		'charname' => array(
                        'name' => 'charname',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '角色名',
//                         'dbType' => "varchar(48)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '48',
                        'scale' => '',
                        'size' => '48',
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
		'serverid' => array(
                        'name' => 'serverid',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '服务器ID',
//                         'dbType' => "int(5)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '5',
                        'scale' => '',
                        'size' => '5',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('serverid'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'charlevel' => array(
                        'name' => 'charlevel',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '领主等级',
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
                        'label'=>$this->getAttributeLabel('charlevel'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'gold' => array(
                        'name' => 'gold',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '金币数量',
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
                        'label'=>$this->getAttributeLabel('gold'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'guildid' => array(
                        'name' => 'guildid',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '主线任务ID',
//                         'dbType' => "bigint(20)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '20',
                        'scale' => '',
                        'size' => '20',
                        'type' => 'bigint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('guildid'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'charstate' => array(
                        'name' => 'charstate',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '角色状态',
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
                        'label'=>$this->getAttributeLabel('charstate'),
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
//                         'comment' => '创建时间',
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
		'updatetime' => array(
                        'name' => 'updatetime',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '最后更新时间',
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
                        'label'=>$this->getAttributeLabel('updatetime'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'loginip' => array(
                        'name' => 'loginip',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '登陆IP',
//                         'dbType' => "varchar(48)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '48',
                        'scale' => '',
                        'size' => '48',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('loginip'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => false,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'viplv' => array(
                        'name' => 'viplv',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => 'VIP等级',
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
                        'label'=>$this->getAttributeLabel('viplv'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'vipexp' => array(
                        'name' => 'vipexp',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => 'VIP经验',
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
                        'label'=>$this->getAttributeLabel('vipexp'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => false,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'firstrechargetime' => array(
                        'name' => 'firstrechargetime',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '首充时间',
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
                        'label'=>$this->getAttributeLabel('firstrechargetime'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => false,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'firstrechargelevel' => array(
                        'name' => 'firstrechargelevel',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '首充等级',
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
                        'label'=>$this->getAttributeLabel('firstrechargelevel'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => false,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'totalrecharge' => array(
                        'name' => 'totalrecharge',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '总充值金额',
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
                        'label'=>$this->getAttributeLabel('totalrecharge'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => false,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		        );
        
    }
 
}
