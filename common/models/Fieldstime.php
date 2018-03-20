<?php

namespace common\models;

use common\core\BaseActiveRecord;
use Yii;

/**
 * This is the model class for table "{{%fieldstime}}".
 *
 * @property int $id id
 * @property int $type 类型，1普通时间段，2VPI时间段
 * @property int $stadiums_id 场馆
 * @property int $fields_id 场地
 * @property int $order_id 订单号
 * @property int $paystate 支付状态
 * @property string $pay_time 创建订单时间
 * @property double $money 价格
 * @property int $state 状态,0未设置，1可预约，2其他
 * @property string $begin_time 开始时间
 * @property string $end_time 结束时间
 * @property string $created_time 创建时间
 * @property string $updated_time 修改时间
 */
class Fieldstime extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fieldstime}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'stadiums_id', 'fields_id', 'order_id', 'paystate', 'state'], 'integer'],
            [['stadiums_id', 'fields_id'], 'required'],
            [['pay_time', 'begin_time', 'end_time', 'created_time', 'updated_time'], 'safe'],
            [['money'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'type' => '类型，1普通时间段，2VPI时间段',
            'stadiums_id' => '场馆',
            'fields_id' => '场地',
            'order_id' => '订单号',
            'paystate' => '支付状态',
            'pay_time' => '创建订单时间',
            'money' => '价格',
            'state' => '状态,0未设置，1可预约，2其他',
            'begin_time' => '开始时间',
            'end_time' => '结束时间',
            'created_time' => '创建时间',
            'updated_time' => '修改时间',
        ];
    }
}
