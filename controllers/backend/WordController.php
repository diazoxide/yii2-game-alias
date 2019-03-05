<?php
/**
 * Project: yii2-blog for internal using
 * Author: diazoxide
 * Copyright (c) 2018.
 */

namespace diazoxide\yii2GameAlias\controllers\backend;

use diazoxide\yii2GameAlias\models\AliasWord;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class WordController extends Controller
{
    public function actionCreate()
    {
        $model = new AliasWord();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('createWord', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }
        return $this->render('updateWord', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new AliasWord;
        $dataProvider = new ActiveDataProvider([
            'query' => $searchModel->find(),
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * @param $id
     * @return AliasWord|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = AliasWord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
