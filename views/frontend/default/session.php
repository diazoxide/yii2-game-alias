<?php

use diazoxide\yii2GameAlias\Module;

/* @var $this yii\web\View */

$this->title = Module::t('Start Game');
?>
<div class="blog-post-book-create">

    <?= $this->render('_session_form', [
        'model' => $model,
    ]) ?>

</div>
