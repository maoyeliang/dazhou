<?php

namespace backend\models;

use Yii;
use yii\base\Model;


class RestpwdForm extends Model
{
    public $password1;
    public $password;
    public $password_repeat = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => '密码',
            'password_repeat' => '重输密码',
        ];
    }

    public function resetPassword($id){
        if (!$this->validate()){
            return null;
        }
        $admin = Admin::findOne($id);
        $admin->password1 = 123;
        $admin->password2 = 123;
        $admin->setPassword($this->password);
        return $admin->save()?true:false;

    }
}
