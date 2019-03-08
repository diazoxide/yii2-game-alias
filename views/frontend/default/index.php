<?php
/**
 * Created by PhpStorm.
 * User: Yordanyan
 * Date: 05.03
 * Time: 15:15
 */

use diazoxide\yii2GameAlias\Module;
use \yii\helpers\Html;
$this->title = Module::t('Alias');

/** @var \diazoxide\yii2GameAlias\models\AliasSession[] $sessions */
?>
<div class="text-center">

    <h1><?= Module::t('Alias') ?></h1>

    <?php foreach ($sessions as $key => $session) {
        echo Html::a(
            $session->name,
            ['game', 'session_id' => $session->id],
            ['class' => 'col-xs-12 top-buffer-20-xs btn btn-lg btn-default']);
    } ?>

    <?= Html::a(Module::t('Start new game'), ['session'], ['id' => 'alias-game-start', 'class' => "top-buffer-20-xs btn btn-success btn-lg"]) ?>

</div>
