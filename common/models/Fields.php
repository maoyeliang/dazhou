<?php

namespace common\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%fields}}".
 *
 * @property int $id
 * @property int $venue_id 场馆
 * @property int $type 场地类型，0未设置，1羽毛球,2篮球
 * @property int $vip_type 0普通，1vip场
 * @property int $material 场地材质
 * @property int $careate_time 创建时间
 * @property int $update_time 更新时间
 *
 * @property Venue $id0
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
            [['venue_id', 'type', 'vip_type', 'material', 'careate_time', 'update_time'], 'integer'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Venue::className(), 'targetAttribute' => ['id' => 'id']],
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
                'createdAtAttribute' => 'careate_time',
                'updatedAtAttribute' => 'update_time',
                'value' => new Expression('NOW()'),
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
            'careate_time' => '创建时间',
            'update_time' => '更新时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Venue::className(), ['id' => 'id']);
    }
}
