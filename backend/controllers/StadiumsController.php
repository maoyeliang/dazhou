<?php

namespace backend\controllers;

use common\components\Upload;
use Yii;
use common\models\Stadiums;
use common\models\StadiumsSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\Json;

/**
 * stadiumsController implements the CRUD actions for Stadiums model.
 */
class StadiumsController extends BaseController
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

    /**
     * Lists all Stadiums models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StadiumsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Stadiums model.
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
     * Creates a new Stadiums model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stadiums();

        if ($model->load(Yii::$app->request->post())) {
            //多图入库之前，先转换成字符串
            is_array($model->imglist) && $model->imglist && $model->imglist = implode(',', $model->imglist);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Stadiums model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //多图入库之前，先转换成字符串
            is_array($model->imglist) && $model->imglist && $model->imglist = implode(',', $model->imglist);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing stadiums model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
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
     * Finds the stadiums model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stadiums the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stadiums::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    /**
     * logo图片上传处理方法
     *
     * */
    public function actionUploadlogo(){
        $this->initImagePath();
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
    /**
     * logo图片上传处理方法
     *
     * */
    public function actionUploadhead(){
        //控制器/类型/用户/1.jpg
        $this->initImagePath();
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
    /**
     * logo图片上传处理方法
     *
     * */
    public function actionUploadlist(){
        $this->initImagePath();
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
    //初始化图片处理
    private function initImagePath(){
        Yii::$app->params['imageUploadRelativePath'] .= Yii::$app->controller->id.'/'.Yii::$app->controller->action->id.'/'. Yii::$app->user->id.'/';
        Yii::$app->params['imageUploadSuccessPath']  = Yii::$app->controller->id.'/'.Yii::$app->controller->action->id.'/'. Yii::$app->user->id.'/';
    }
}
