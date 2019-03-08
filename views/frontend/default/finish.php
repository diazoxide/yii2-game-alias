<?php

use diazoxide\yii2GameAlias\Module;
use yii\helpers\Html;

/** @var \diazoxide\yii2GameAlias\models\AliasSession $session */
/** @var \diazoxide\yii2GameAlias\models\AliasWord[] $words */
$this->title = Module::t('Game Finished');

?>
<div class="text-center">
    <h1><?= Module::t('Results') ?></h1>
    <div id="alias-game-info" class="top-buffer-20-xs">
        <table class="table">
            <?php foreach ($session->players as $player): ?>
                <tr>
                    <td><?= $player->name ?></td>
                    <td><?= $player->points ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?= Html::a(Module::t('Click to restart start game'), ['game', 'session_id' => $session->id, 'reset' => 1], ['id' => 'alias-game-start', 'class' => "top-buffer-20-xs btn btn-primary btn-lg"]) ?>
</div>

