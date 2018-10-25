<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\connect\controllers\ConnectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('property_conn_ingredients', 'Property Conn Ingredients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-conn-ingredients-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('property_conn_ingredients', 'Create Property Conn Ingredients'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ingredients_id',
            'property_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
