<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "game_atvremain".
 *
 * @property integer $serverid
 * @property string $spid
 * @property string $sbid
 * @property integer $oldusers
 * @property integer $oldusers_full
 * @property string $logdate
 */
class GameAtvremain extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_atvremain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serverid', 'spid', 'sbid', 'logdate'], 'required'],
            [['serverid', 'oldusers', 'oldusers_full'], 'integer'],
            [['logdate'], 'safe'],
            [['spid', 'sbid'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'serverid' => '服务器ID',
            'spid' => '渠道ID',
            'sbid' => '子渠道ID',
            'oldusers' => '老活跃(单服)',
            'oldusers_full' => '老活跃(全服)',
            'logdate' => '日期',
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
        'serverid' => array(
                        'name' => 'serverid',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '服务器ID',
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
                        'label'=>$this->getAttributeLabel('serverid'),
                        'inputType' => 'hidden',
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
//                         'dbType' => "varchar(16)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'string',
                        'precision' => '16',
                        'scale' => '',
                        'size' => '16',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('spid'),
                        'inputType' => 'hidden',
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
//                         'dbType' => "varchar(16)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'string',
                        'precision' => '16',
                        'scale' => '',
                        'size' => '16',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('sbid'),
                        'inputType' => 'hidden',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'oldusers' => array(
                        'name' => 'oldusers',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '老活跃(单服)',
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
                        'label'=>$this->getAttributeLabel('oldusers'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'oldusers_full' => array(
                        'name' => 'oldusers_full',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '老活跃(全服)',
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
                        'label'=>$this->getAttributeLabel('oldusers_full'),
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
//                         'comment' => '日期',
//                         'dbType' => "datetime",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'datetime',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('logdate'),
                        'inputType' => 'hidden',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		        );
        
    }
 
}
