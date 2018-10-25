<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\connect\models\PropertyConnIngredients */

$this->title = Yii::t('property_conn_ingredients', 'Update Property Conn Ingredients: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('property_conn_ingredients', 'Property Conn Ingredients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('property_conn_ingredients', 'Update');
?>
<div class="property-conn-ingredients-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
