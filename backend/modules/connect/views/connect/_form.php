<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\connect\models\PropertyConnIngredients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-conn-ingredients-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ingredients_id')->textInput() ?>

    <?= $form->field($model, 'property_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('property_conn_ingredients', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
