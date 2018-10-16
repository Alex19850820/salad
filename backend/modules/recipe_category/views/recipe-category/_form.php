<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\recipe_category\models\RecipeCategory */
/* @var $form yii\widgets\ActiveForm */
$recepies = [];
foreach (\backend\modules\recipes\models\Recipes::find()->where(['!=','status',0])->all() as $item) {
	$recepies[$item->id] = $item->name;
}
$params = [
	'prompt' => 'Выберите рецепт...'
];
?>

<div class="recipe-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recipes_id')->dropDownList($recepies, $params) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($model, 'status')->dropDownList([
		'0' => 'Отключен',
		'1' => 'Активный',
	]);
	?>
	
	<?= $form->field($model, 'dt_add')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('recipe_category', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
