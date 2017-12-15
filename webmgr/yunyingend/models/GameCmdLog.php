<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "game_cmd_log".
 *
 * @property integer $id
 * @property integer $serverid
 * @property string $cmd
 * @property string $data
 * @property string $result
 * @property string $opperson
 * @property string $notes
 * @property string $record_time
 */
class GameCmdLog extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_cmd_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serverid'], 'integer'],
            [['data', 'opperson'], 'required'],
            [['data'], 'string'],
            [['record_time'], 'safe'],
            [['cmd'], 'string', 'max' => 32],
            [['result', 'notes'], 'string', 'max' => 255],
            [['opperson'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'serverid' => '服务器ID',
            'cmd' => '指令名',
            'data' => '参数',
            'result' => '执行结果',
            'opperson' => '操作人',
            'notes' => '操作原因',
            'record_time' => '记录时间',
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
        'id' => array(
                        'name' => 'id',
                        'allowNull' => false,
//                         'autoIncrement' => true,
//                         'comment' => '',
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
                        'label'=>$this->getAttributeLabel('id'),
                        'inputType' => 'hidden',
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
                        'label'=>$this->getAttributeLabel('serverid'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'cmd' => array(
                        'name' => 'cmd',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '指令名',
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
                        'label'=>$this->getAttributeLabel('cmd'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'data' => array(
                        'name' => 'data',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '参数',
//                         'dbType' => "text",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'text',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('data'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'result' => array(
                        'name' => 'result',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '执行结果',
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
                        'label'=>$this->getAttributeLabel('result'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'opperson' => array(
                        'name' => 'opperson',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '操作人',
//                         'dbType' => "char(64)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '64',
                        'scale' => '',
                        'size' => '64',
                        'type' => 'char',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('opperson'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'notes' => array(
                        'name' => 'notes',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '操作原因',
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
                        'label'=>$this->getAttributeLabel('notes'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'record_time' => array(
                        'name' => 'record_time',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '记录时间',
//                         'dbType' => "timestamp",
                        'defaultValue' => null,
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'timestamp',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('record_time'),
                        'inputType' => 'text',
                        'isEdit' => false,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		        );
        
    }
 
}
