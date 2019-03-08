<?php
/**
 * Project: yii2-blog for internal using
 * Author: diazoxide
 * Copyright (c) 2018.
 */

namespace diazoxide\yii2GameAlias\controllers\frontend;

use diazoxide\yii2GameAlias\models\AliasSessionPlayer;
use diazoxide\yii2GameAlias\models\AliasWord;
use diazoxide\yii2GameAlias\models\AliasSession;
use diazoxide\yii2GameAlias\Module;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\db\Expression;

/**
 * @property string cookieId
 */
class DefaultController extends Controller
{

    private $cookieKey = 'diazoxide_game_alias_session';


    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSession()
    {
        if (Yii::$app->request->get('id')) {
            $model = $this->findSessionModel(Yii::$app->request->get('id'));
        } else {
            $model = new AliasSession();
            $model->cookie_id = $this->cookieId;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->redirect(['players', 'session_id' => $model->id]);
        }


        return $this->render('session', [
            'model' => $model
        ]);

    }

    /**
     * @param $session_id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionFinish($session_id)
    {
        $session = $this->findSessionModel($session_id);
        if (!$session->isFinished()) {
            $this->redirect(['game', 'session_id' => $session_id]);
        }

        return $this->render('finish', [
            'session' => $session,
        ]);

    }

    /**
     * @param $session_id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionGame($session_id)
    {
        $session = $this->findSessionModel($session_id);

        if (Yii::$app->request->get('reset') == 1) {
            $session->reset();
        }

        if ($session->isFinished()) {
            $this->redirect(['finish', 'session_id' => $session_id]);
        }
        if (!$session->player) {
            $player = $session->getPlayers()->one();
            $session->player_id = $player->id;
            $session->save();
        }

        //$player = $session->player;
        //alias-game-words
        $words = AliasWord::find()->orderBy(new Expression('rand()'))->all();

        if (Yii::$app->request->post('alias-game-words')) {
            $session->player->points += count(Yii::$app->request->post('alias-game-words'));
            $session->player->save();

            foreach ($session->players as $key => $p) {
                if ($p->id == $session->player_id) {
                    if (count($session->players) == $key + 1) {
                        $index = 0;
                    } else {
                        $index = $key + 1;
                    }
                    $player_id = $session->players[$index]->id;
                    break;
                }
            }
            $session->player_id = $player_id;
            $session->save();
            $this->refresh();
        }

        return $this->render('game', [
            'session' => $session,
            'words' => $words
        ]);

    }

    /**
     * @param $session_id
     * @return string
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\StaleObjectException
     */
    public function actionPlayers($session_id)
    {

        $model = $this->findSessionModel($session_id);
        $playerModel = new AliasSessionPlayer();
        $playerModel->session_id = $session_id;


        if (Yii::$app->request->post($playerModel->formName())['id']) {
            $playerModel = $this->findSessionPlayerModel(Yii::$app->request->post($playerModel->formName())['id'], $session_id);

            if (isset(Yii::$app->request->post($playerModel->formName())['delete'])) {
                if ($playerModel->delete()) {
                    $this->redirect(Yii::$app->request->referrer);
                    return true;
                } else {
                    print_r($playerModel->errors);
                }
            }
        }


        if ($playerModel->load(Yii::$app->request->post())) {
            $playerModel->save();
            $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('players', [
            'model' => $model,
            'playerModel' => $playerModel
        ]);

    }

    public function actionIndex()
    {
        $sessions = AliasSession::findAll(['cookie_id' => $this->cookieId]);

        return $this->render('index', [
            'sessions' => $sessions,
        ]);
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

            $cookies = Yii::$app->response->cookies;

            $cookies->add(new \yii\web\Cookie([
                'name' => $this->cookieKey,
                'value' => $id,
            ]));
        }

        return $id;
    }

    /**
     * @param $id
     * @return AliasSession|null
     * @throws NotFoundHttpException
     */
    protected function findSessionModel($id)
    {
        if (($model = AliasSession::find()->where(['id'=>$id,'cookie_id'=>$this->cookieId])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $id
     * @return \yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    protected function findSessionPlayerModel($id, $session_id)
    {
        if (($model = AliasSessionPlayer::find()->where(['id' => $id, 'session_id' => $session_id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
