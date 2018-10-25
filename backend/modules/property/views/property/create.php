<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\property\models\Property */

$this->title = Yii::t('property', 'Create Property');
$this->params['breadcrumbs'][] = ['label' => Yii::t('property', 'Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
