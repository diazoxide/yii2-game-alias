<?php

namespace diazoxide\yii2GameAlias;

use diazoxide\yii2GameAlias\assets\AppAsset;
use Yii;
use yii\i18n\PhpMessageSource;

/**
 * @property string url
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'diazoxide\blog\controllers\frontend';

    protected $_isBackend;

    public $title = 'Game Alias';

    public $urlManager = 'urlManager';

    public $imgFilePath = '@frontend/web/img/games/alias';

    public $imgFileUrl = '/img/games/alias';

    public $viewLayout = null;

    /** @var User user (for example, 'common\models\User::class' */
    public $userModel;// = \common\models\User::class;

    /** @var string Primary Key for user table, by default 'id' */
    public $userPK = 'id';

    /** @var string username uses in view (may be field `username` or `email` or `login`) */
    public $userName = 'username';



    public $htmlClass = "diazoxide_game_alias_";

    /**
     *
     */
    public function init()
    {
        parent::init();
        if ($this->getIsBackend() === true) {
            $this->setViewPath('@vendor/diazoxide/yii2-game-alias/views/backend');
        } else {
            $this->setViewPath('@vendor/diazoxide/yii2-game-alias/views/frontend');
            $this->setLayoutPath('@vendor/diazoxide/yii2-game-alias/views/frontend/layouts');

            AppAsset::register(Yii::$app->view);

        }
        $this->registerTranslations();

    }


    protected function registerTranslations()
    {
        Yii::$app->i18n->translations['diazoxide/yii2GameAlias'] = [
            'class' => PhpMessageSource::class,
            'basePath' => '@vendor/diazoxide/yii2-yii2-game-alias/messages',
            'forceTranslation' => true,
            'fileMap' => [
                'diazoxide/yii2GameAlias' => 'blog.php',
            ]
        ];

    }

    public static function t($message, $params = [], $language = null)
    {
        return Yii::t('diazoxide/yii2GameAlias', $message, $params, $language);
    }

    /**
     * Check if module is used for backend application.
     *
     * @return boolean true if it's used for backend application
     */
    public function getIsBackend()
    {
        if ($this->_isBackend === null) {
            $this->_isBackend = strpos($this->controllerNamespace, 'backend') === false ? false : true;
        }

        return $this->_isBackend;
    }

    /**
     * Need correct Full IMG URL for Backend
     *
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getImgFullPathUrl()
    {
        return \Yii::$app->get($this->urlManager)->getHostInfo() . $this->imgFileUrl;
    }

    public static function getBackendNavigation()
    {
        return [
//                        ['label' => 'Tags', 'url' => ['/blog/blog-tag'], 'visible' => Yii::$app->user->can("BLOG_VIEW_TAGS")],
        ];
    }


    public function getUrl()
    {

//        Yii::$app->controller->module->id;


        if ($this->getIsBackend()) {
            return Yii::$app->getUrlManager()->createUrl(['alias/default/index']);
        }
        return Yii::$app->getUrlManager()->createAbsoluteUrl(['alias/default/index']);

    }

    public function getBreadcrumbs()
    {
        $result = [];
        $result[] = ['label' => Module::t( $this->title), 'url' => $this->url];
        return $result;
    }

}
