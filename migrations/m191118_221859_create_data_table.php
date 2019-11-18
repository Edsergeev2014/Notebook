<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%data}}`.
 */
class m191118_221859_create_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users', [
            'id'=>1,
            'email'=>'test1@test.ru',
            'passwordHash'=> '1',
        ]);
        $this->insert('users', [
            'id'=>2,
            'email'=>'test2@test.ru',
            'passwordHash'=> '1',
        ]);

        $this->batchInsert('activity', 
            ['title', 'dateStart', 'isBlocked', 'userId'], [
                ['title1', date('Y-m-d'),0,1],
                ['title2', date('Y-m-d'),1,1],
                ['title3', date('Y-m-d'),1,1],
                ['title4', date('Y-m-d'),0,2],
                ['title5', '2019-11-11', 0,2],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('users');
        
    }
}
