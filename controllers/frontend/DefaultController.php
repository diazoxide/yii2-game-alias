<?php
/**
 * Project: yii2-blog for internal using
 * Author: diazoxide
 * Copyright (c) 2018.
 */

namespace diazoxide\yii2GameAlias\controllers\frontend;

use diazoxide\yii2GameAlias\models\AliasWord;
use diazoxide\yii2GameAlias\models\AliasSession;
use diazoxide\yii2GameAlias\Module;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * @property string cookieId
 */
class DefaultController extends Controller
{

    private $cookieKey = 'diazoxide_game_alias_session';

    public function actionStart()
    {
        $model = new AliasSession();
        $model->cookie_id = $this->cookieId;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->redirect(['session', 'id' => $model->id]);
        }


        return $this->render('start', [
            'model' => $model
        ]);

    }

    public function actionSession($id)
    {


        return $this->render('session');

    }

    public function actionIndex()
    {

        echo $this->cookieId;
        //return $this->render('index');

    }

    /**
     * @throws \yii\base\Exception
     */
    public function getCookieId()
    {

        $cookies = Yii::$app->request->cookies;

        $id = $cookies->getValue($this->cookieKey, NULL);

        if ($id == NULL) {

            $id = Yii::$app->security->generateRandomString(12);

            $cookies->add(new \yii\web\Cookie([
                'name' => $this->cookieKey,
                'value' => $id,
            ]));
        }

        return $id;
    }
}
