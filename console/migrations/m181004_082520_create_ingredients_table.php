<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ingredients`.
 */
class m181004_082520_create_ingredients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ingredients', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255),
            'description' => $this->text(),
	        'dt_add' => $this->dateTime(),
	        'status' => $this->tinyInteger(3),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ingredients');
    }
}
