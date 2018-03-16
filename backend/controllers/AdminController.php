<?php

namespace backend\controllers;

use backend\models\RestpwdForm;
use common\components\Upload;
use Yii;
use backend\models\Admin;
use backend\models\search\AdminSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
/**
 * UserController implements the CRUD actions for User model.
 */
class AdminController extends BaseController
{
    /*
       * ---------------------------------------
       * 构造方法
       * ---------------------------------------
       */
    public function init(){
        parent::init();
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /*
     * ---------------------------------------
     * 用户列表
     * ---------------------------------------
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 展示一条记录详细信息
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * 创建一条新的管理员帐号
     * @return mixed
     */
    public function actionCreate()
    {
        //指定图片处理地址
        Yii::$app->params['webuploader']['uploadUrl'] = 'admin/upload';
        $model = new Admin();

        $model->setPassword($model->password1);
        $model->generateAuthKey();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //如果创建成功。浏览器将被重新定向到视图页面
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * 更新用户
     * 如果更新成功，跳转到详细视图页面
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        Yii::$app->params['webuploader']['uploadUrl'] = 'user/upload';
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->password1);
            is_array($model->headphoto) && $model->headphoto &&  $model->headphoto = implode(',', $model->headphoto);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * 删除用户
     * 如果删除成功，跳转到首页
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * 重置密码
     * 如果重置密码成功，跳转到首页
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionResetpwd($id){
        $model = new RestpwdForm();

        if ($model->load(Yii::$app->request->post())) {

            if($model->resetPassword($id))
            {
                return $this->redirect(['index']);
            }
        }

        return $this->render('resetpwd', [
            'model' => $model,
        ]);


    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * 头像上传
     */
    public function actionUpload()
    {
         Yii::$app->params['imageUploadRelativePath'] .=  'user/';
         Yii::$app->params['imageUploadSuccessPath']  = 'user/';
        try {
            $model = new Upload();
            $info = $model->upImage();


            $info && is_array($info) ?
                exit(Json::htmlEncode($info)) :
                exit(Json::htmlEncode([
                    'code' => 1,
                    'msg' => 'error'
                ]));


        } catch (\Exception $e) {
            exit(Json::htmlEncode([
                'code' => 1,
                'msg' => $e->getMessage()
            ]));
        }
    }
}
