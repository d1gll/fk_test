<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%characters}}`.
 */
class m230902_113854_create_characters_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%characters}}', [
            'id_char' => $this->primaryKey(),
            'character' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%characters}}');
    }
}
