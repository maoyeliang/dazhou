<?php

namespace common\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%fields}}".
 *
 * @property int $id
 * @property int $stadiums_id 场馆
 * @property int $type 场地类型，0未设置，1羽毛球,2篮球
 * @property int $vip_type 0普通，1vip场
 * @property int $material 场地材质
 * @property int $created_time 创建时间
 * @property int $updated_time 更新时间
 *
 * @property Stadiums $id0
 */
class Fields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fields}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['venue_id', 'type', 'vip_type'], 'required'],
            [['venue_id', 'type', 'vip_type', 'material', ], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Stadiums::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }
    /**
     * {@inheritdoc}
     * 自动设置时间戳
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_time',
                'updatedAtAttribute' => 'updated_time',
                'value' => new Expression('now()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'venue_id' => '场馆',
            'type' => '场地类型，0未设置，1羽毛球,2篮球',
            'vip_type' => '0普通，1vip场',
            'material' => '场地材质',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Stadiums::className(), ['id' => 'stadiums_id']);
    }
}
