<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m180703_073002_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'date' => $this->integer(11)->notNull(),
            'description' => $this->text(),
            'user_id' => $this->integer(11)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);

        $this->addForeignKey('fk_task_user', 'task', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_task_user', 'task');
        $this->dropTable('task');
    }
}
