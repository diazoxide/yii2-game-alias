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
 * @property string $session_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property AliasSessionPlayer[] players
 * @property AliasSessionPlayer player
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
            [['session_id', 'time', 'points'], 'required'],
            [['time', 'points', 'player_id'], 'integer'],
            [['session_id'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'session_id' => Module::t('Session ID'),
        ];
    }


    public function getPlayers()
    {
        return $this->hasMany(AliasSessionPlayer::className(), ['session_id' => 'id']);
    }


    public function getPlayer()
    {
        return $this->hasOne(AliasSessionPlayer::className(), ['id' => 'player_id']);
    }

    public function isFinished()
    {
        if ($this->getPlayers()->andWhere('points>=' . $this->points)->count()) {
            return true;
        }
        return false;
    }

    public function reset()
    {
        foreach ($this->players as $player) {
            $player->points = 0;
            $player->save();
        }
    }

    public function getName()
    {
        $title = Module::t('Game') . ' ';
        $title .= "(";
        foreach ($this->players as $pIndex => $player) {
            $title .= $player->name;
            if ($pIndex + 1 != count($this->players)) {
                $title .= ',';
            }
        }
        $title .= ")";
        return $title;
    }
}
