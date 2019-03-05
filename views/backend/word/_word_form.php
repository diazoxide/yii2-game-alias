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

<div class="blog-post-form">


    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-md-12 text-right">
            <?= Html::submitButton($model->isNewRecord ? Module::t('Create') : Module::t('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
        </div>
    </div>


    <div class="row top-buffer-20">
        <div class="col-md-8">

            <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
