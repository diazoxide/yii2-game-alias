<?php
/**
 * Project: yii2-blog for internal using
 * Author: diazoxide
 * Copyright (c) 2018.
 */

use diazoxide\yii2GameAlias\models\AliasWord;
use diazoxide\yii2GameAlias\Module;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model diazoxide\yii2GameAlias\models\AliasWord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alias-session-form">


    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'default')->hiddenInput(['value'=>'1'])->label(false) ?>


    <div class="col-md-12 text-right">
        <?= Html::submitButton($model->isNewRecord ? Module::t('Start Game') : Module::t('Resume Game'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
