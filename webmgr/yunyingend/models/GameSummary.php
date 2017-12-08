<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "game_summary".
 *
 * @property integer $id
 * @property integer $serverid
 * @property string $spid
 * @property integer $total_reg
 * @property integer $total_max_online
 * @property integer $total_charnge_mony
 * @property integer $total_charge_person
 * @property integer $total_login
 * @property string $date
 * @property string $update_time
 */
class GameSummary extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_summary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serverid', 'spid'], 'required'],
            [['serverid', 'total_reg', 'total_max_online', 'total_charnge_mony', 'total_charge_person', 'total_login'], 'integer'],
            [['date', 'update_time'], 'safe'],
            [['spid'], 'string', 'max' => 16]
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
            'spid' => '渠道ID',
            'total_reg' => '总注册',
            'total_max_online' => '最高在线总数(h)',
            'total_charnge_mony' => '总充值金额(元)',
            'total_charge_person' => '总充值人数',
            'total_login' => '总登陆数',
            'date' => '日期',
            'update_time' => '更新时间',
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
//                         'dbType' => "int(10) unsigned",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('serverid'),
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
//                         'dbType' => "char(16)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '16',
                        'scale' => '',
                        'size' => '16',
                        'type' => 'char',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('spid'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'total_reg' => array(
                        'name' => 'total_reg',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '总注册',
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
                        'label'=>$this->getAttributeLabel('total_reg'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'total_max_online' => array(
                        'name' => 'total_max_online',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '最高在线总数(h)',
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
                        'label'=>$this->getAttributeLabel('total_max_online'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'total_charnge_mony' => array(
                        'name' => 'total_charnge_mony',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '总充值金额(元)',
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
                        'label'=>$this->getAttributeLabel('total_charnge_mony'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'total_charge_person' => array(
                        'name' => 'total_charge_person',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '总充值人数',
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
                        'label'=>$this->getAttributeLabel('total_charge_person'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'total_login' => array(
                        'name' => 'total_login',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '总登陆数',
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
                        'label'=>$this->getAttributeLabel('total_login'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'date' => array(
                        'name' => 'date',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '日期',
//                         'dbType' => "date",
                        'defaultValue' => '0000-00-00',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'date',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('date'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'update_time' => array(
                        'name' => 'update_time',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '更新时间',
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
                        'label'=>$this->getAttributeLabel('update_time'),
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
