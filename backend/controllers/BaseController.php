<?php
namespace backend\controllers;

use common\core\Controller;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\helpers\Url;

/*
 * ---------------------------------------
 * 后台父类控制器 
 * 后台所有控制器都继承自该类
 * ---------------------------------------
 */
class BaseController extends Controller
{

    /* 控制器默认操作 */
    public $defaultAction = 'index';

    /* 布局页面 优先级 控制器中>设置中>系统默认，false关闭 */
    public $layout = 'main';

    /* 定义变量,在layout中用$this->context访问 */
    public $menu   = [];       // 当前用户允许访问的栏目
    public $breadcrumbs = [];  // 面包屑导航
    public $admins = [];       // 当前登录的管理员信息
    public $title_sub = '';    // 页面子标题或提示

    /*
     * ---------------------------------------
     * 后台构造函数
     * ---------------------------------------
     */
    public function init(){
        /* 判断是否登录 */
        if (\Yii::$app->user->getIsGuest()) {
            $this->redirect(Url::toRoute(['/login/login']));
            Yii::$app->end();
        }

        /* 获取当前登录用户信息 */
        $this->admins = Yii::$app->user->identity->getAttributes();

        //TODO 解析数据库配置，解析后存放在Yii::$app->params['web']中
       // Yii::$app->params['web'] = Config::lists();

    }
    
    /*
     * ---------------------------------------
     * TODO 在执行所有动作之前，先执行这个方法。没想好用来干什么
     * @param  int    $id  参数信息 
     * @return bool   true-继续执行/false-终止执行
     * ---------------------------------------
     */
    public function beforeAction($action){
       return true;
    }
    

    
    /*
     * ------*---------------------------------
     * 标记当前位置到cookie供后续跳转调用
     * ---------------------------------------
     */
    public function setForward(){
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name'  => '__forward__',
            'value' => $_SERVER['REQUEST_URI'],
        ]));
    }

    /*
     * ---------------------------------------
     * 函数功能信息 public private protected static
     * @param  int    $id  参数信息
     * @return json   返回信息
     * ---------------------------------------
     */
    public function getForward($default=''){
        $default = $default ? $default : Url::toRoute([Yii::$app->controller->id.'/index']);
        return Yii::$app->request->cookies->getValue('__forward__', $default);
    }

    /**
     * ---------------------------------------
     * 传统分页列表数据集获取方法
     * @param sting|Model  $model   模型名或模型实例
     * @param array        $where   where查询条件
     * @param array|string $order   排序条件
     * @return array|false
     * ---------------------------------------
     */
    public function lists($model, $where=[], $order=''){
        $query = $model::find()->where($where);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 10,

        ]);
        $data  = $query->orderBy($order)->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return [$data, $pages];
    }

    /**
     * ---------------------------------------
     * dataProvider列表数据集获取方法
     * @param sting|Model  $model   模型名或模型实例
     * @param array        $where   where查询条件
     * @param array|string $order   排序条件
     * @return array|false
     * ---------------------------------------
     */
    public function lists1($model, $where=[], $order=''){
        $query = $model::find()->where($where)->orderBy($order)->asArray();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $dataProvider;
    }

    /**
     * ---------------------------------------
     * 修改数据表一条记录的一条值
     * @param string $model 模型名称
     * @param array  $data 数据
     * @return boolean
     * ---------------------------------------
     */
    public function addRow( $model, $data){
        if (empty($data)) {
            return false;
        }
        $m = new $model;
        if ($m->load($data, '') && $m->validate()) {
            /* 添加到数据库中,save()会自动验证rule */
            if ($m->save()) {
                return $m->getPrimaryKey();
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * ---------------------------------------
     * 修改数据表一条记录的一条值
     * @param string $model 模型名称
     * @param string $pk  主键名称
     * @param array  $data 数据
     * @return boolean
     * ---------------------------------------
     */
    public function editRow( $model, $pk = 'id', $data){
        if (empty($data)) {
            return false;
        }
        if (!isset($data[$pk]) || !$data[$pk]) {
            return false;
        }
        $m = $model::findOne($data[$pk]);
        if (empty($m)) {
            return false;
        }
        if ($m->load($data, '') && $m->validate()) {
            /* 添加到数据库中,save()会自动验证rule */
            if ($m->save()) {
                return $m;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * ---------------------------------------
     * 由表主键删除数据表中的多条记录
     * @param string $model 模型名称,供M函数使用的参数
     * @param array  $pk  修改的数据
     * @return boolean
     * ---------------------------------------
     */
    public function delRow( $model, $pk='id' ){
        $ids = Yii::$app->request->param($pk, 0);
        $ids = implode(',', array_unique((array)$ids));

        if ( empty($ids) ) {
            return false;
        }

        $_where = $pk.' in('.$ids.')';
        if($model::deleteAll($_where)){
            return true;
        } else {
            return false;
        }
    }




    /**
     * ----------------------------------------------
     * 操作错误跳转的快捷方法
     * @access protected
     * @param string $message 错误信息
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @return void
     * -----------------------------------------------
     */
    protected function error($message='',$jumpUrl='',$ajax=false) {
        $this->dispatchJump($message,0,$jumpUrl,$ajax);
    }

    /**
     * ----------------------------------------------
     * 操作成功跳转的快捷方法
     * @access protected
     * @param string $message 提示信息
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @return void
     * ----------------------------------------------
     */
    protected function success($message='',$jumpUrl='',$ajax=false) {
        $this->dispatchJump($message,1,$jumpUrl,$ajax);
    }

    /**
     * ----------------------------------------------
     * 默认跳转操作 支持错误导向和正确跳转
     * 调用模板显示 默认为public目录下面的success页面
     * 提示页面为可配置 支持模板标签
     * @param string $message 提示信息
     * @param Boolean $status 状态
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @access private
     * @return void
     * ----------------------------------------------
     */
    private function dispatchJump($message,$status=1,$jumpUrl='',$ajax=false) {
        $jumpUrl = !empty($jumpUrl)? (is_array($jumpUrl)?Url::toRoute($jumpUrl):$jumpUrl):'';
        if(true === $ajax || Yii::$app->request->isAjax) {// AJAX提交
            $data           =   is_array($ajax)?$ajax:array();
            $data['info']   =   $message;
            $data['status'] =   $status;
            $data['url']    =   $jumpUrl;
            $this->ajaxReturn($data);
        }
        // 成功操作后默认停留1秒
        $waitSecond = 3;

        if($status) { //发送成功信息
            $message = $message ? $message : '提交成功' ;// 提示信息
            // 默认操作成功自动返回操作前页面
            echo $this->renderFile(Yii::$app->params['action_success'],[
                'message' => $message,
                'waitSecond' => $waitSecond,
                'jumpUrl' => $jumpUrl,
            ]);
        }else{
            $message = $message ? $message : '发生错误了' ;// 提示信息
            // 默认发生错误的话自动返回上页
            $jumpUrl = "javascript:history.back(-1);";
            echo $this->renderFile(Yii::$app->params['action_error'], [
                'message' => $message,
                'waitSecond' => $waitSecond,
                'jumpUrl' => $jumpUrl,
            ]);
        }
        //Yii::$app->end();
        exit;
    }

    /**
     * ------------------------------------------------
     * Ajax方式返回数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @return void
     * ------------------------------------------------
     */
    protected function ajaxReturn($data) {
        // 返回JSON数据格式到客户端 包含状态信息
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($data);
        //Yii::$app->end();
        exit;
    }

}
