<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "game_sp".
 *
 * @property string $spId
 * @property string $spName
 * @property integer $groupId
 * @property string $notes
 */
class GameSp extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_sp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spId', 'spName'], 'required'],
            [['groupId'], 'integer'],
            [['spId'], 'string', 'max' => 8],
            [['spName'], 'string', 'max' => 32],
            [['notes'], 'string', 'max' => 200],
            [['spName'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'spId' => '运营商id',
            'spName' => '运营商名',
            'groupId' => '分组ID',
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
        'spId' => array(
                        'name' => 'spId',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '运营商id',
//                         'dbType' => "varchar(8)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'string',
                        'precision' => '8',
                        'scale' => '',
                        'size' => '8',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('spId'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'spName' => array(
                        'name' => 'spName',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '运营商名',
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
                        'label'=>$this->getAttributeLabel('spName'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'groupId' => array(
                        'name' => 'groupId',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '分组ID',
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
                        'label'=>$this->getAttributeLabel('groupId'),
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
//                         'comment' => '备注',
//                         'dbType' => "varchar(200)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '200',
                        'scale' => '',
                        'size' => '200',
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
