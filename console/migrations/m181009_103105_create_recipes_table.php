<?php

use yii\db\Migration;

/**
 * Handles the creation of table `recipes`.
 */
class m181009_103105_create_recipes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('recipes', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(),
            'description' => $this->text(),
            'status' => $this->tinyInteger(3)->unsigned(),
            'slug' => $this->string(),
            'dt_add' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('recipes');
    }
}
