<?php

use yii\db\Migration;

/**
 * Handles adding position to table `property_conn_ingredients`.
 */
class m181018_132219_add_position_column_to_property_conn_ingredients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('property_conn_ingredients', 'status', $this->tinyInteger(3)->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('property_conn_ingredients', 'status');
    }
}
