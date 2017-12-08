<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "gamelog_10001_20171116".
 *
 * @property integer $eventId
 * @property integer $playerId
 * @property string $playerName
 * @property string $playerAccount
 * @property integer $viplv
 * @property integer $charlevel
 * @property integer $targetId
 * @property string $targetName
 * @property string $field1
 * @property string $field2
 * @property string $field3
 * @property string $field4
 * @property string $field5
 * @property string $field6
 * @property string $field7
 * @property string $field8
 * @property string $field9
 * @property string $field10
 * @property string $time
 */
class GameLog extends \backend\models\BaseModel
{
	
	public static $tableName;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
    	if (self::$tableName){
    		return self::$tableName;
    	}
        return 'gamelog_99001_20171116';
    }
    
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('log_db');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eventId', 'playerId', 'playerName', 'playerAccount'], 'required'],
            [['eventId', 'playerId', 'viplv', 'charlevel', 'targetId'], 'integer'],
            [['time'], 'safe'],
            [['playerName', 'targetName'], 'string', 'max' => 48],
            [['playerAccount', 'field1', 'field2', 'field3', 'field4', 'field5', 'field6', 'field7', 'field8', 'field9', 'field10'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eventId' => '行为ID',
            'playerId' => '角色ID',
            'playerName' => '角色名',
            'playerAccount' => '账号',
            'viplv' => 'VIP等级',
            'charlevel' => '领主等级',
            'castleLevel' => '城堡等级',
            'countryId' => '国家',
            'targetId' => '目标ID',
            'targetName' => '目标名',
            'field1' => '数据1',
            'field2' => '数据2',
            'field3' => '数据3',
            'field4' => '数据4',
            'field5' => '数据5',
            'field6' => '数据6',
            'field7' => '数据7',
            'field8' => '数据8',
            'field9' => '数据9',
            'field10' => '数据10',
            'time' => '日志时间',
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
        'eventId' => array(
                        'name' => 'eventId',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '行为ID',
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
                        'label'=>$this->getAttributeLabel('eventId'),
                        'inputType' => 'hidden',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'playerId' => array(
                        'name' => 'playerId',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '角色ID',
//                         'dbType' => "bigint(20)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '20',
                        'scale' => '',
                        'size' => '20',
                        'type' => 'bigint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('playerId'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'playerName' => array(
                        'name' => 'playerName',
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
                        'label'=>$this->getAttributeLabel('playerName'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'playerAccount' => array(
                        'name' => 'playerAccount',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '账号',
//                         'dbType' => "varchar(128)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '128',
                        'scale' => '',
                        'size' => '128',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('playerAccount'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
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
		'charlevel' => array(
                        'name' => 'charlevel',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '角色等级',
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
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'targetId' => array(
                        'name' => 'targetId',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '目标ID',
//                         'dbType' => "bigint(20)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '20',
                        'scale' => '',
                        'size' => '20',
                        'type' => 'bigint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('targetId'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'targetName' => array(
                        'name' => 'targetName',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '目标名',
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
                        'label'=>$this->getAttributeLabel('targetName'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'field1' => array(
                        'name' => 'field1',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '数据1',
//                         'dbType' => "varchar(128)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '128',
                        'scale' => '',
                        'size' => '128',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('field1'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'field2' => array(
                        'name' => 'field2',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '数据2',
//                         'dbType' => "varchar(128)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '128',
                        'scale' => '',
                        'size' => '128',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('field2'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'field3' => array(
                        'name' => 'field3',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '数据3',
//                         'dbType' => "varchar(128)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '128',
                        'scale' => '',
                        'size' => '128',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('field3'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'field4' => array(
                        'name' => 'field4',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '数据4',
//                         'dbType' => "varchar(128)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '128',
                        'scale' => '',
                        'size' => '128',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('field4'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'field5' => array(
                        'name' => 'field5',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '数据5',
//                         'dbType' => "varchar(128)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '128',
                        'scale' => '',
                        'size' => '128',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('field5'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'field6' => array(
                        'name' => 'field6',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '数据6',
//                         'dbType' => "varchar(128)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '128',
                        'scale' => '',
                        'size' => '128',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('field6'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'field7' => array(
                        'name' => 'field7',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '数据7',
//                         'dbType' => "varchar(128)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '128',
                        'scale' => '',
                        'size' => '128',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('field7'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'field8' => array(
                        'name' => 'field8',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '数据8',
//                         'dbType' => "varchar(128)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '128',
                        'scale' => '',
                        'size' => '128',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('field8'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'field9' => array(
                        'name' => 'field9',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '数据9',
//                         'dbType' => "varchar(128)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '128',
                        'scale' => '',
                        'size' => '128',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('field9'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'field10' => array(
                        'name' => 'field10',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '数据10',
//                         'dbType' => "varchar(128)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '128',
                        'scale' => '',
                        'size' => '128',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('field10'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'time' => array(
                        'name' => 'time',
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
                        'label'=>$this->getAttributeLabel('time'),
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
