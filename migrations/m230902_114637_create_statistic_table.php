<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%statistic}}`.
 */
class m230902_114637_create_statistic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%statistic}}', [
            'id' => $this->primaryKey(),
            'id_name' =>  $this->integer()->notNull(),
            'id_char' => $this->integer()->notNull(),
            'point' => $this->integer()->notNull(),
        ]);


        $this->createIndex(
            'idx-statistic-id_name',
            'statistic',
            'id_name'
        );


        $this->addForeignKey(
            'fk-statistic-id_name',
            'statistic',
            'id_name',
            'players',
            'id_name',
            'CASCADE'
        );


        $this->createIndex(
            'idx-statistic-id_char',
            'statistic',
            'id_char'
        );


        $this->addForeignKey(
            'fk-statistic-id_char',
            'statistic',
            'id_char',
            'characters',
            'id_char',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%statistic}}');
    }
}
