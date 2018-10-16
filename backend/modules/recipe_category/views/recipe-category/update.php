<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\recipe_category\models\RecipeCategory */

$this->title = Yii::t('recipe_category', 'Update Recipe Category: ' . $model->name, [
    'nameAttribute' => '' . $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipe_category', 'Recipe Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('recipe_category', 'Update');
?>
<div class="recipe-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
