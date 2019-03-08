<?php
/**
 * Created by PhpStorm.
 * User: Yordanyan
 * Date: 05.03
 * Time: 15:15
 */

use diazoxide\yii2GameAlias\Module;
use yii\helpers\Html;

/** @var \diazoxide\yii2GameAlias\models\AliasSession $session */
/** @var \diazoxide\yii2GameAlias\models\AliasWord[] $words */
$this->title = Module::t($session->player->name . ' '.Module::t('Playing'));

?>
    <div class="text-center">
        <h1><?= $session->player->name; ?></h1>
        <h4 id="alias-game-time" class="text-center"><?= $session->time; ?></h4>
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
        <?= Html::a(Module::t('Start'), null, ['id' => 'alias-game-start', 'class' => "btn btn-danger btn-lg"]) ?>
    </div>


    <div id="alias-game-content" class="hidden">
        <div class="top-buffer-20-xs">
            <div class="top-buffer-20-xs text-center">
                <?= Html::beginForm(['', 'session_id' => $session->id], 'POST', ['id' => 'alias-game-form']); ?>
                <?= Html::checkboxList('alias-game-words', [], \yii\helpers\ArrayHelper::map($words, 'id', 'title'), [
                    'itemOptions' => [
                        'labelOptions' => [
                            'class' => 'btn btn-lg btn-default col-xs-12 top-buffer-10-xs',
                        ],
                    ],
                    'id' => "alias-words"
                ]) ?>
                <?= Html::endForm(); ?>
            </div>
        </div>
    </div>


<?php
$script = <<<JS
var labels = $('#alias-words label');
var audioBaseUrl = "http://www.soundjay.com/button/";

labels.addClass('hidden');
var limit = 5;
var start = 0;
var end = limit;

var curLabels = labels.slice( start, end );
curLabels.removeClass('hidden');


$('#alias-words input[type=checkbox]').change(function(){
    console.log('CHECKED');
    if($(this).prop('checked')){   
        $(this).parent().removeClass('btn-default').addClass('btn-warning');
        new Audio(audioBaseUrl+"beep-08b.mp3").play();

    }else{
        $(this).parent().removeClass('btn-warning').addClass('btn-default');
        new Audio(audioBaseUrl+"beep-03.mp3").play();
    }
    
    var i = 0;
    curLabels.each(function(index) {
      if($(this).children('input[type=checkbox]').prop('checked')){
          i++;
      }
    });
    
    if(i === limit){
      start +=limit;
      end+=limit;
      curLabels = labels.slice(start, end);
      labels.addClass('hidden');
      curLabels.removeClass('hidden');
    }
    
});

var timeleft = {$session->time};

$('#alias-game-start').click(function() {
    $(this).hide();
    $('#alias-game-info').hide();
    $('#alias-game-content').removeClass('hidden');
    var timer = setInterval(function(){
        $('#alias-game-time').html(timeleft);
        //$('#alias-game-progress').val(timeleft);
        timeleft -= 1;
        if(timeleft <= 0){
            clearInterval(timer);
            new Audio(audioBaseUrl+"beep-05.mp3").play();
            setTimeout(function() {
                $('#alias-game-form').submit();
            },1000);
      }
    }, 1000);
});



JS;

$this->registerJs($script);
?>