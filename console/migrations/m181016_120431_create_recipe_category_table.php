<?php

use yii\db\Migration;

/**
 * Handles the creation of table `recipe_category`.
 */
class m181016_120431_create_recipe_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('recipe_category', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(),
            'recipes_id' => $this->integer()->unsigned(),
            'description' => $this->text(),
	        'status' => $this->tinyInteger(3)->unsigned(),
            'dt_add' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('recipe_category');
    }
}
