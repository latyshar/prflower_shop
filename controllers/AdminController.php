<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
class AdminController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function beforeAction($action)
    {
        if ((Yii::$app->user->isGuest) || (Yii::$app->user->identity->administrator==0)){
        $this->redirect(['site/login']);
        return false;
    } else return true;
 }


}
