<?php

namespace diazoxide\yii2GameAlias\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@vendor/diazoxide/yii2-game-alias/assets/default';

    public $baseUrl = '@web';

    public $css = [
        'css/style.css',
        'css/bootstrap_custom.css',
    ];

    public $js = [
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'diazoxide\yii2GameAlias\assets\FontAwesomeAsset',
    ];
}
