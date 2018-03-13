<?php
namespace backend\models;

use common\models\Venue;
use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * 实现User组件中的身份识别类 参见 yii\web\user
 * User model
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
class Admin extends \common\models\Admin implements IdentityInterface
{

    //密码验证
    public $password1;
    public $password2;
    //状态验证
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;



    /**
     * @return \yii\db\ActiveQuery 返回门店信息
     */
    public function getVenue()
    {
        return $this->hasOne(Venue::className(), ['id' => 'venue_id']);
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
       // return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * 根据用户名获取账号信息
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
      //  return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
          //  'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * 验证密码
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * 设置加密后的密码
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
