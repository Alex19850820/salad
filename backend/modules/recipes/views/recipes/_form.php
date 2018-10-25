<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\modules\recipes\models\Recipes */
/* @var $form yii\widgets\ActiveForm */
/**
 * @var $data array
 **/

?>

<div class="recipes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($model, 'ingrToRecipes')->widget(Select2::classname(), [
		'data' => $data,
		'language' => 'ru',
		'options' => ['multiple' => true, 'placeholder' => 'Выберите св-ва'],
		'pluginOptions' => [
			'allowClear' => true
		],
	])->label('Св-во');?>
	

	
		<?= $form->field($model, 'status')->dropDownList([
			'0' => 'Отключен',
			'1' => 'Активный',
		]);
		?>
	
	<?= $form->field($model, 'dt_add')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('recipes', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
