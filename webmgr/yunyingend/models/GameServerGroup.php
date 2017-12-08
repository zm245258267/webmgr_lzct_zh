<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%game_server_group}}".
 *
 * @property integer $id
 * @property integer $groupId
 * @property integer $pid
 * @property string $groupName
 * @property string $spids
 * @property integer $cversion_higher
 * @property integer $cversion_lower
 * @property string $notes
 */
class GameServerGroup extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%game_server_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['groupId', 'pid', 'cversion_higher', 'cversion_lower'], 'integer'],
            [['groupName'], 'required'],
            [['groupName'], 'string', 'max' => 60],
            [['spids'], 'string', 'max' => 1024],
            [['notes'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增ID',
            'groupId' => '自定义分组ID',
            'pid' => '父分组ID',
            'groupName' => '分组名',
            'spids' => '渠道',
            'cversion_higher' => '最大CPP版本',
            'cversion_lower' => '最小CPP版本',
            'notes' => '备注',
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
//                         'comment' => '自增ID',
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
                        'isEdit' => false,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'groupId' => array(
                        'name' => 'groupId',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '自定义分组ID',
//                         'dbType' => "tinyint(4) unsigned",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '4',
                        'scale' => '',
                        'size' => '4',
                        'type' => 'smallint',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('groupId'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'pid' => array(
                        'name' => 'pid',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '父分组ID',
//                         'dbType' => "smallint(5) unsigned",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '5',
                        'scale' => '',
                        'size' => '5',
                        'type' => 'smallint',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('pid'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'groupName' => array(
                        'name' => 'groupName',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '分组名',
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
                        'label'=>$this->getAttributeLabel('groupName'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'spids' => array(
                        'name' => 'spids',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '渠道',
//                         'dbType' => "varchar(1024)",
                        'defaultValue' => 'ALL',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '1024',
                        'scale' => '',
                        'size' => '1024',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('spids'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
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
		'notes' => array(
                        'name' => 'notes',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '备注',
//                         'dbType' => "varchar(100)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '100',
                        'scale' => '',
                        'size' => '100',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('notes'),
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
