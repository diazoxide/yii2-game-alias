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

<div class="alias-session-player-form">


    <? \yii\widgets\Pjax::begin() ?>
    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'options' => [
                'tag' => false,
            ],
            'template' => "{input}\n{error}",
            'errorOptions' => ['tag' => null]

        ],
    ]); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id',['options'=>['class'=>'hidden']])->hiddenInput()->label(false) ?>

    <div class="input-group">
        <?= $form
            ->field($model, 'name')
            ->textInput((['maxlength' => 255, 'placeholder' => $model->getAttributeLabel('name')]))
            ->label(false); ?>


        <div class="input-group-btn">

            <?= $form->field($model, 'submit')->input('submit', ['value' => Module::t($model->isNewRecord ? "Add" : "Change"), 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning'])->label(false) ?>

            <?= $model->isNewRecord ? "" : $form->field($model, 'delete')->input('submit', ['value' => Module::t("Delete"), 'class' => 'btn btn-danger'])->label(false) ?>

        </div>

    </div>


    <?php ActiveForm::end(); ?>

    <? \yii\widgets\Pjax::end() ?>

</div>
