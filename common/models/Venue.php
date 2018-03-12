<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%venue}}".
 *
 * @property int $id id
 * @property string $name 场馆名
 * @property string $telphone 电话
 * @property string $manager 馆长姓名
 * @property string $imglogo logo图片
 * @property string $imghead 头部图片
 * @property string $imglist 介绍图片
 * @property string $address 地址
 * @property string $location 位置
 * @property string $shophours 营业时间
 * @property int $state 状态
 * @property string $paykomw 购买须知
 * @property string $note 注意事项
 * @property string $description 简介
 * @property int $updated_time 更新时间
 * @property int $created_time 创建时间
 *
 * @property User[] $users
 */
class Venue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%venue}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'telphone', 'manager', 'address', 'location', 'paykomw', 'note', 'description'], 'required'],
            [['state', 'updated_time', 'created_time'], 'integer'],
            [['name', 'telphone', 'manager', 'imglogo', 'imghead', 'imglist', 'address', 'location', 'shophours', 'paykomw', 'note', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => '场馆名',
            'telphone' => '电话',
            'manager' => '馆长姓名',
            'imglogo' => 'logo图片',
            'imghead' => '头部图片',
            'imglist' => '介绍图片',
            'address' => '地址',
            'location' => '位置',
            'shophours' => '营业时间',
            'state' => '状态',
            'paykomw' => '购买须知',
            'note' => '注意事项',
            'description' => '简介',
            'updated_time' => '更新时间',
            'created_time' => '创建时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['venue_id' => 'id']);
    }
}
