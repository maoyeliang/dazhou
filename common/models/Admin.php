<?php
namespace common\models;

use common\core\BaseActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * Admin model
 * This is the model class for table "{{%user}}".
 * @property int $id
 * @property string $username 用户名
 * @property string $auth_key 登录cokie
 * @property string $password1 密码
 * @property string $password2 确认密码
 * @property string $password_hash 密码MD5加密
 * @property string $password_reset_token 重置密码令牌
 * @property string $email 邮箱
 * @property string $nickname 姓名
 * @property int $venue_id 场馆
 * @property string $headphoto 头像
 * @property string $phone 手机号
 * @property int $status 状态：0未激活，1已激活，2已锁定，3已停用
 * @property int $last_time 最后登录时间
 * @property int $created_time 创建时间
 * @property int $updated_time 修改时间
 */
class Admin extends BaseActiveRecord
{

    //密码验证
    public $password1;
    public $password2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admin}}';
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
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //  ['status', 'default', 'value' => self::STATUS_ACTIVE],
            //   ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['username', 'password1', 'password2', 'email', 'nickname', 'phone',], 'required',],
            [['venue_id', 'phone', 'status',  ], 'integer'],
            [['username', 'auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'email', 'nickname', 'headphoto'], 'string', 'max' => 255],
            [['created_time', 'updated_time'], 'safe'],
            ['password2', 'compare', 'compareAttribute' => 'password1'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'password1' => '密码',
            'password2' => '确认密码',
            'username' => '用户名',
            'auth_key' => '登录cokie',
            'password_hash' => '密码MD5加密',
            'password_reset_token' => '重置密码令牌',
            'email' => '邮箱',
            'nickname' => '姓名',
            'venue_id' => '场馆',
            'headphoto' => '头像',
            'phone' => '手机号',
            'status' => '状态',
            'last_time' => '最后登录时间',
            'created_time' => '创建时间',
            'updated_time' => '修改时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery 返回门店信息
     */
    public function getVenue()
    {
        return $this->hasOne(Venue::className(), ['id' => 'venue_id']);
    }

}