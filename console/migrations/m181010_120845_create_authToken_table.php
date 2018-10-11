<?php

use yii\db\Migration;

/**
 * Handles the creation of table `authToken`.
 */
class m181010_120845_create_authToken_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('authToken', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer(11)->unsigned(),
            'token' => $this->string(255),
            'dt_add' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('authToken');
    }
}
