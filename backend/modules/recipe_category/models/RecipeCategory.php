<?php

namespace backend\modules\recipe_category\models;

use Yii;

/**
 * This is the model class for table "recipe_category".
 *
 * @property int $id
 * @property string $name
 * @property int $recipes_id
 * @property string $description
 * @property int $status
 * @property string $dt_add
 */
class RecipeCategory extends \common\models\RecipeCategory
{

}
