<?php

use yii\db\Migration;

/**
 * Handles the creation of table `property_to_ingredients`.
 */
class m181017_145637_create_property_conn_ingredients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('property_conn_ingredients', [
            'id' => $this->primaryKey()->unsigned(),
            'ingredients_id' => $this->integer()->unsigned(),
            'property_id' => $this->integer()->unsigned(),
        ]);
	
	    // creates index for column `id`
	    $this->createIndex(
		    'idx-conn-ingredients_id',
		    'property_conn_ingredients',
		    'ingredients_id'
	    );
	
	    // creates index for column `ingredient_id`
	    $this->createIndex(
		    'idx-property-property_id',
		    'property_conn_ingredients',
		    'property_id'
	    );
	    
	    // add foreign key for table `prop`
	    $this->addForeignKey(
		    'fk-conn-property_id',
		    'property_conn_ingredients',
		    'property_id',
		    'property',
		    'id',
		    'CASCADE');

	    $this->addForeignKey(
		    'fk-conn-ingredients_id',
		    'property_conn_ingredients',
		    'ingredients_id',
		    'ingredients',
		    'id',
		    'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('property_conn_ingredients');
    }
}
