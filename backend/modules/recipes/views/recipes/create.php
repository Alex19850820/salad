<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\recipes\models\Recipes */
/**
 * @var $ingredients object
 **/

$this->title = Yii::t('recipes', 'Create Recipes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipes', 'Recipes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'ingredients' => $ingredients,
    ]) ?>

</div>
