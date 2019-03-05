<?php

use diazoxide\yii2GameAlias\Module;

/* @var $this yii\web\View */

$this->title = Module::t('Start Game');
$this->params['breadcrumbs'][] = ['label' => Module::t('Alias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('Start')];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-book-create">

    <?= $this->render('_session_form', [
        'model' => $model,
    ]) ?>

</div>
