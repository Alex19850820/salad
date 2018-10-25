<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\recipes\models\Recipes */
//$model->description = $model->setDescription($model->id);
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipes', 'Recipes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//$model->description = implode(',' , $model->getDescription());
//$ingridients = \common\models\Ingredients::find()->where(['id' => $model->getDescription()])->all();
//$str = "";
//foreach ($ingridients as $ingridient) {
//	$str .= $ingridient->name.",";
//}
//$model->description = $str;
?>
<div class="recipes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('recipes', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('recipes', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('recipes', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'ingrToRecipes',
            'status',
            'slug',
            'dt_add',
        ],
    ]) ?>

</div>
