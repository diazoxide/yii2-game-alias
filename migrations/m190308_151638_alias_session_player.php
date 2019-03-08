<?php

use yii\db\Schema;
use yii\db\Migration;

class m190308_151638_alias_session_player extends Migration
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
            '{{%alias_session_player}}',
            [
                'id'=> $this->primaryKey(11),
                'session_id'=> $this->integer(11)->notNull(),
                'name'=> $this->string(255)->notNull(),
                'points'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%alias_session_player}}');
    }
}
