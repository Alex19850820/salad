<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\ingredients\models\Ingredients */

$this->title = Yii::t('ingredients', 'Update Ingredients: ' . $model->name, [
    'nameAttribute' => '' . $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ingredients', 'Ingredients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ingredients', 'Update');
?>
<div class="ingredients-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
