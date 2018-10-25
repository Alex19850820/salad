<?php

namespace backend\modules\connect\models;

use Yii;

/**
 * This is the model class for table "property_conn_ingredients".
 *
 * @property int $id
 * @property int $ingredients_id
 * @property int $property_id
 *
 * @property Ingredients $ingredients
 * @property Property $property
 */
class PropertyConnIngredients extends \common\models\PropertyConnIngredients
{

}
