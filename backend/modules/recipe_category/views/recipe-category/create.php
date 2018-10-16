<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\recipe_category\models\RecipeCategory */

$this->title = Yii::t('recipe_category', 'Create Recipe Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipe_category', 'Recipe Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
