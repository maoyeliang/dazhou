<?php
namespace frontend\components;

use common\models\Wxuser;
use Yii;
use yii\base\Model;

/**
 * Login form
 *
 * @property integer $openId
 */
class WxuserIdentity extends Model
{

    private $openId;
    private $_user;





    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
            return Yii::$app->user->login($this->getUser(),  3600 * 24 * 7);

    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Wxuser::findOne(['openid'=>$this->openId]);
        }

        return $this->_user;
    }



    public function setOpenId($openId)
    {
         $this->openId = $openId ;
    }


}
