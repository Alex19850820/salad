<?php

use yii\db\Migration;

/**
 * Handles dropping position from table `property`.
 */
class m181018_100730_drop_position_column_from_property_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('property', 'ingredients_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('property', 'ingredients_id', $this->integer()->unsigned());
    }
}
