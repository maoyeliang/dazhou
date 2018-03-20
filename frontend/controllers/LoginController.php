<?php
namespace frontend\controllers;

use frontend\components\WxuserIdentity;
use common\models\Wxuser;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * 登录控制器
 * TODO 考虑不直接继承基础控制器
 */
class LoginController extends Controller
{

    public $wxUser;

    /**
     * 微信请求关闭CSRF验证
     * @var bool
     */
    public $enableCsrfValidation = false;

    /**
     * 微信授权认证
     */
    public function actionWxlogin(){
        //授权
        if(Yii::$app->wechat->isWechat && !Yii::$app->wechat->isAuthorized()) {
            return Yii::$app->wechat->authorizeRequired()->send();
        }

        $wxUser = Wxuser::findOne(['openid' =>Yii::$app->wechat->user->openId]);
        if($wxUser){
            //更新个人信息
            $wxUser->nickname = Yii::$app->wechat->user->original['nackname'];
            $wxUser->sex = Yii::$app->wechat->user->original['sex'];
            $wxUser->city = Yii::$app->wechat->user->original['city'];
            $wxUser->country = Yii::$app->wechat->user->original['country'];
            $wxUser->headimgurl = Yii::$app->wechat->user->original['headimgurl'];
            $wxUser->nickname = Yii::$app->wechat->user->original['nackname'];
            $wxUser->save();

        }else{
            $wxUser = new Wxuser();
            $wxUser->openid = Yii::$app->wechat->user->original['openid'];
            $wxUser->nickname = Yii::$app->wechat->user->original['nackname'];
            $wxUser->sex = Yii::$app->wechat->user->original['sex'];
            $wxUser->city = Yii::$app->wechat->user->original['city'];
            $wxUser->country = Yii::$app->wechat->user->original['country'];
            $wxUser->headimgurl = Yii::$app->wechat->user->original['headimgurl'];
            $wxUser->nickname = Yii::$app->wechat->user->original['nackname'];
            $wxUser->time = date("Y-m-d H:i:s", intval(time()));
            $wxUser->save();

        }

        Yii::$app->user->login($wxUser,  3600 * 24 * 7);

        return Yii::$app->wechat->authorizeRequired()->send();
    }


}
