<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%players}}`.
 */
class m230902_113838_create_players_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%players}}', [
            'id_name' => $this->primaryKey(),
            'name' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%players}}');
    }
}
