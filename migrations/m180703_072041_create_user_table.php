<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180703_072041_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'login' => $this->string(255)->notNull(),
            'name' => $this->string(255)->notNull(),
            'password' => $this->string(255)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
