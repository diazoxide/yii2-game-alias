<?php

use diazoxide\yii2GameAlias\Module;

/* @var $this yii\web\View */

/** @var \diazoxide\yii2GameAlias\models\AliasWord $model */

$this->title = Module::t('Update ') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('Alias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('Words')];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="alias-word-update">

    <?= $this->render('_word_form', [
        'model' => $model,
    ]) ?>

</div>