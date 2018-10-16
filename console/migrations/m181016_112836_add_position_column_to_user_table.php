<?php

use yii\db\Migration;

/**
 * Handles adding position to table `user`.
 */
class m181016_112836_add_position_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'access_token', $this->string('255'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'access_token');
    }
}
