<?php
/**
 * Project: yii2-blog for internal using
 * Author: diazoxide
 * Copyright (c) 2018.
 */

namespace diazoxide\yii2GameAlias\models;

use diazoxide\yii2GameAlias\Module;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "blog_comment".
 *
 * @property integer $id
 * @property string $cookie_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 */
class AliasSession extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%alias_session}}';
    }

    /**
     * created_at, updated_at to now()
     * crate_user_id, update_user_id to current login user id
     */
    public function behaviors()
    {
        return [
            'class' => TimestampBehavior::className(),
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cookie_id'], 'required'],
            [['cookie_id'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'cookie_id' => Module::t('Cookie ID'),
        ];
    }


    public function getPlayers()
    {
        return $this->hasMany(AliasSessionPlayer::className(), ['session_id' => 'id']);
    }


}
