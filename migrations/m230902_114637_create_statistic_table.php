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

        // creates index for column `author_id`
        $this->createIndex(
            'idx-statistic-id_name',
            'statistic',
            'id_name'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-statistic-id_name',
            'statistic',
            'id_name',
            'players',
            'id_name',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            'idx-statistic-id_char',
            'statistic',
            'id_char'
        );

        // add foreign key for table `category`
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
