<?php

namespace app\controllers;

class DashboardController extends \yii\web\Controller
{
    public $layout = 'main';

    public function actionIndex()
    {
        return $this->render('index');
    }

}
