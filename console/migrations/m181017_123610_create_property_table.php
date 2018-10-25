<?php

use yii\db\Migration;

/**
 * Handles the creation of table `property`.
 */
class m181017_123610_create_property_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('property', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(),
            'description' => $this->text(),
            'ingredients_id' => $this->integer()->unsigned(),
            'status' => $this->tinyInteger(3)->unsigned(),
            'dt_add' => $this->dateTime(),
        ]);
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('property');
    }
}
