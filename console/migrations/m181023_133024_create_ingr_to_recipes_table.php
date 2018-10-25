<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ingr_to_recipes`.
 */
class m181023_133024_create_ingr_to_recipes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ingr_to_recipes', [
            'id' => $this->primaryKey()->unsigned(),
            'ingredients_id' => $this->integer()->unsigned(),
            'recipes_id' => $this->integer()->unsigned(),
        ]);
	
	    // creates index for column `id`
	    $this->createIndex(
		    'idx-ingtorec-ingredients_id',
		    'ingr_to_recipes',
		    'ingredients_id'
	    );
	
	    // creates index for column `ingredient_id`
	    $this->createIndex(
		    'idx-ingtorec-recipes_id',
		    'ingr_to_recipes',
		    'recipes_id'
	    );
	
	    // add foreign key for table `prop`
	    $this->addForeignKey(
		    'fk-ingrtorec-recipes_id',
		    'ingr_to_recipes',
		    'recipes_id',
		    'recipes',
		    'id',
		    'CASCADE');
	
	    $this->addForeignKey(
		    'fk-ingrtorec-ingredients_id',
		    'ingr_to_recipes',
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
        $this->dropTable('ingr_to_recipes');
    }
}
