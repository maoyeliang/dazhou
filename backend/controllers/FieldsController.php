<?php

namespace backend\controllers;

use common\models\Fieldstime;
use Yii;
use common\models\Fields;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FieldsController implements the CRUD actions for Fields model.
 */
class FieldsController extends BaseController
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
     * Lists all Fields models.
     * @return mixed
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Fields::find()->where(['venue_id'=>Yii::$app->user->identity->venue_id]),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fields model.
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
     * Creates a new Fields model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fields();

        if ($model->load(Yii::$app->request->post())){
            $model->venue_id = Yii::$app->user->identity->venue_id;

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Fields model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fields model.
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

    public function actionInfo()
    {

        if (Yii::$app->request->get('datetime')){
            $datetime = strtotime(Yii::$app->request->get('datetime'));

        }else{
            $datetime =  date("Y-m-d",intval(time()));
            $datetime = strtotime($datetime);
        }

        $fields = Fields::findAll(['venue_id'=>Yii::$app->user->identity->venue_id]);

        foreach ($fields as $field){
            for($i = 6; $i < 23; $i++){
                $begin_time = $datetime + ($i * 3600);
                $fieldtime = Fieldstime::findOne(['begin_time' => date("Y-m-d H:i:s",intval($begin_time)),'fields_id'=>$field->id]);
                $fieldstime[$field->id][$i] = $fieldtime;
            }
        }

        $view['fieldstime'] =  $fieldstime;
        $view['datetime'] =  $datetime;
        return $this->render('info',$view);
    }

    public function actionEdit(){
        //需要要设置的时间段
        $fieldsinfo = Yii::$app->request->post('fieldsinfo');
        //日期
        $dateinfo = Yii::$app->request->post('dateinfo');
        //类型
        $type = Yii::$app->request->post('type');
        //价格
        $money = Yii::$app->request->post('money');
        //date("Y-m-d H:i:s",intval($dateinfo + ($fieldinfo * 3600)))
        //0未设置，1可预约，2待支付，3已经预约，4禁止预约，5其他
        switch ($type){
            case 0:
                foreach ($fieldsinfo as $key=>$value){
                    foreach ($value as $fieldinfo){
                        Fieldstime::findOne(['fields_id'=>$key,begin_time=>date("Y-m-d H:i:s",intval($dateinfo + ($fieldinfo * 3600)))])->delete();
                    }
                };
                break;
            case 1:
                foreach ($fieldsinfo as $key=>$value){
                    foreach ($value as $fieldinfo){
                        $model = new Fieldstime();
                        $model->type = 0;
                        $model->venue_id = Yii::$app->user->identity->venue_id;
                        $model->fields_id = $key;
                        $model->money = $money;
                        $model->state = 1;
                        $model->begin_time = date("Y-m-d H:i:s",intval($dateinfo + ($fieldinfo * 3600)));
                        $model->end_time = date("Y-m-d H:i:s",intval($dateinfo + ($fieldinfo * 3600)+3600-1));
                        $model->created_time = date("Y-m-d H:i:s",intval(time()));
                        $model->updated_time =  date("Y-m-d H:i:s",intval(time()));
                        $model->save();
                    }

                };
                break;
            case 2:
                return '可预约';
                break;
            case 3:
                return '已预约';
                break;
            case 4:
                return '禁止预约';
                break;
            case 5:
                return '其他';
                break;
        }


        return $this->redirect(['info','datetime'=>date("Y-m-d",intval($dateinfo))]);

    }

    /**
     * Finds the Fields model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fields the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fields::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
