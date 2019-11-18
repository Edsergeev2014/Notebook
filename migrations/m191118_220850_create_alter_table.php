<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%alter}}`.
 */
class m191118_220850_create_alter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity', 'userId', $this->integer()->notNull());
        $this->addForeignKey('activeUserFK', 'activity', 'userId', 'users', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%alter}}', 'userId');
    }
}
