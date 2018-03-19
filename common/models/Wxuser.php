<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wxuser}}".
 *
 * @property int $id
 * @property string $openid 微信表示
 * @property string $name
 * @property int $phone 手机
 * @property string $nickname 微信昵称
 * @property int $sex 性别0女1男
 * @property string $country 国家
 * @property string $province 省份
 * @property string $city 城市
 * @property string $headimgurl 头像
 * @property int $subscribe 关注状态
 * @property int $status 会员状态
 * @property string $lastTime 最后登录时间
 * @property string $regTime 注册时间
 * @property string $subscribe_time 最后关注时间
 * @property string $time 创建时间
 */
class Wxuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wxuser}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'phone', 'sex', 'subscribe', 'status'], 'integer'],
            [['lastTime', 'regTime', 'subscribe_time', 'time'], 'safe'],
            [['openid', 'name', 'headimgurl'], 'string', 'max' => 255],
            [['nickname', 'country', 'province', 'city'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'openid' => '微信表示',
            'name' => 'Name',
            'phone' => '手机',
            'nickname' => '微信昵称',
            'sex' => '性别0女1男',
            'country' => '国家',
            'province' => '省份',
            'city' => '城市',
            'headimgurl' => '头像',
            'subscribe' => '关注状态',
            'status' => '会员状态',
            'lastTime' => '最后登录时间',
            'regTime' => '注册时间',
            'subscribe_time' => '最后关注时间',
            'time' => '创建时间',
        ];
    }
}
