<?php

namespace api\controllers;

use common\models\Wxuser;
use Yii;
use yii\web\Controller;
use EasyWeChat\Message\News;
use EasyWeChat\Message\Text;

/**
 * Site controller
 */
class WeixinController extends Controller
{
    public $wxUser;

    /**
     * 微信请求关闭CSRF验证
     * @var bool
     */
    public $enableCsrfValidation = false;


    public function actionIndex()
    {

        $app = Yii::$app->wechat->app;

        $server = $app->server;

        $server->setMessageHandler(function ($message) {
            switch ($message->MsgType) {
                case 'event':
                    return $this->matchEvent($message);
                    break;
                case 'text':
                    return '文本消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
        });

        $response = $server->serve();

        $response->send();

    }

    //事件处理
    public function matchEvent($message)
    {
        switch ($message->Event) {
            //用户关注事件
            case 'subscribe':
                $this->getWxUser($message);
                $this->setWxUser($message);
                return '感谢您的关注';
                # code...
                break;
            //用户取消关注事件
            case 'unsubscribe':
                $this->getWxUser($message);
                $this->setWxUser($message,1);
                break;
            //用户已关注时的事件推送
            case 'SCAN':
                # code...
                break;
            //上报地理位置事件
            case 'LOCATION':
                # code...
                break;
            //点击菜单拉取消息时的事件推送
            case 'CLICK':
                # code...
                break;
            //点击菜单跳转链接时的事件推送
            case 'VIEW':
                # code...
                break;

            default:
                # code...
                break;
        }


    }

    public function getWxUser($message)
    {
        $this->wxUser = Wxuser::findOne(['openid' => $message->FromUserName]);
    }

    public function setWxUser($message, $type =0)
    {
        //关注0，取消关注1
        switch ($type) {
            //用户关注事件
            case '0':
                if (!$this->wxUser) {
                    $wxuser = new Wxuser();
                    $wxuser->openid = $message->FromUserName;
                    $wxuser->subscribe = 1;
                    $wxuser->subscribe_time = date("Y-m-d H:i:s", intval(time()));
                    $wxuser->time = date("Y-m-d H:i:s", intval(time()));
                    $wxuser->save();
                } else {
                    $this->wxUser->subscribe = 1;
                    $this->wxUser->subscribe_time = date("Y-m-d H:i:s", intval(time()));
                    $this->wxUser->save();
                }
                # code...
                break;
            case '1':
                $this->wxUser->subscribe = 0;
                $this->wxUser->save();
                # code...
                break;

        }

    }

}
