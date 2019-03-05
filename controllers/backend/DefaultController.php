<?php
/**
 * Project: yii2-blog for internal using
 * Author: diazoxide
 * Copyright (c) 2018.
 */

namespace diazoxide\yii2GameAlias\controllers\backend;

use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect("user/login");
        }
        return $this->render('index');
    }
}
