<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\connect\controllers\ConnectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-conn-ingredients-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ingredients_id') ?>

    <?= $form->field($model, 'property_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('property_conn_ingredients', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('property_conn_ingredients', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
