<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%activity}}`.
 */
class m191118_213531_create_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%activity}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string('150')->notNull(),
            'description' => $this->text(),
            'dateStart' => $this->dateTime()->notNull(),
            'isBlocked' => $this->boolean()->notNull()->defaultValue(0),
            'email' => $this->string('150'),
            'createAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%activity}}');
    }
}
