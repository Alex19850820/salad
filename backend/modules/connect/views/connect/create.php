<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\connect\models\PropertyConnIngredients */

$this->title = Yii::t('property_conn_ingredients', 'Create Property Conn Ingredients');
$this->params['breadcrumbs'][] = ['label' => Yii::t('property_conn_ingredients', 'Property Conn Ingredients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-conn-ingredients-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
