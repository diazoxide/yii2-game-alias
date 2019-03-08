<?php
/**
 * Created by PhpStorm.
 * User: Yordanyan
 * Date: 05.03
 * Time: 15:15
 */

use diazoxide\yii2GameAlias\Module;

$this->title = Module::t(Module::t('Players'));


/** @var \diazoxide\yii2GameAlias\models\AliasSessionPlayer $playerModel */
?>
<div>


    <p class="text-right"><?= Module::t("Time:").' '.$model->time ?> | <?= Module::t("Points:").' '.$model->points ?></p>

    <h1><?= Module::t("Players") ?></h1>

    <?php foreach ($model->players as $player): ?>
        <div class="top-buffer-20-xs">

            <?= $this->render('_player_form', ['model' => $player]); ?>

        </div>

    <?php endforeach; ?>

    <div class="top-buffer-20-xs">
        <?= $this->render('_player_form', ['model' => $playerModel]); ?>
    </div>

    <div class="top-buffer-40-xs text-center">
        <?= \yii\helpers\Html::a(Module::t('Start Game'), ['game', 'session_id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </div>
</div>
