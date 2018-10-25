<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\recipes\models\Recipes */
/**
* @var $data array
 **/

$this->title = Yii::t('recipes', 'Update Recipes: ' . $model->name, [
    'nameAttribute' => '' . $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipes', 'Recipes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('recipes', 'Update');
?>
<div class="recipes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'data' => $data,
    ]) ?>

</div>
