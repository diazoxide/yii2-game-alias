<?php

use yii\db\Schema;
use yii\db\Migration;

class m190308_151637_alias_session extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%alias_session}}',
            [
                'id'=> $this->primaryKey(11),
                'points'=> $this->integer(11)->notNull(),
                'time'=> $this->integer(11)->notNull(),
                'player_id'=> $this->integer(11)->notNull(),
                'cookie_id'=> $this->string(16)->notNull(),
                'created_at'=> $this->integer(11)->notNull(),
                'updated_at'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%alias_session}}');
    }
}
