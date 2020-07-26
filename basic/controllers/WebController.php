<?php

namespace app\controllers;

use app\index\controller\Login;
use app\models\LoginForm;
use app\models\SignupForm;
use yii\base\Model;
use yii\filters\AccessControl;

class WebController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                  ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $model = new SignupForm();

        if ($model->load(\Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (\Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', ['model' => $model]);

    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(\Yii::$app->request->post())) {
            if ($user = $model->signup()) {
//                if (\Yii::$app->getUser()->login($user)){
                return $this->goHome();
//                }
            }
        }
        return $this->render('signup', ['model' => $model]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post())) {
            if ($user = $model->login()) {
                return $this->goHome();
            }
        }
        return $this->render('login', ['model' => $model]);
    }

}
