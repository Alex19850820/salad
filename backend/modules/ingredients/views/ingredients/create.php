<?php

use yii\helpers\Html;

/***
* @var $data array
 */
/* @var $this yii\web\View */
/* @var $model backend\modules\ingredients\models\Ingredients */

$this->title = Yii::t('ingredients', 'Create Ingredients');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ingredients', 'Ingredients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredients-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'data' => $data
    ]) ?>

</div>
