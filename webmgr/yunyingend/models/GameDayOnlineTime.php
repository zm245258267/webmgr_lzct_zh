<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "game_day_online_time".
 *
 * @property string $account
 * @property integer $server
 * @property integer $onlinetime
 * @property string $logdate
 */
class GameDayOnlineTime extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_day_online_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account'], 'required'],
            [['server', 'onlinetime'], 'integer'],
            [['logdate'], 'safe'],
            [['account'], 'string', 'max' => 64],
            [['account', 'server', 'logdate'], 'unique', 'targetAttribute' => ['account', 'server', 'logdate'], 'message' => 'The combination of 账号, 服务器 and 日期 has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'account' => '账号',
            'server' => '服务器',
            'onlinetime' => '在线时长(s)',
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
        'account' => array(
                        'name' => 'account',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '账号',
//                         'dbType' => "varchar(64)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'string',
                        'precision' => '64',
                        'scale' => '',
                        'size' => '64',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('account'),
                        'inputType' => 'hidden',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'server' => array(
                        'name' => 'server',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '服务器',
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
                        'label'=>$this->getAttributeLabel('server'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'onlinetime' => array(
                        'name' => 'onlinetime',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '在线时长(s)',
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
                        'label'=>$this->getAttributeLabel('onlinetime'),
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
