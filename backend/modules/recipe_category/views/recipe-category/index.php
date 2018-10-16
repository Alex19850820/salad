<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\recipe_category\controllers\RecipeCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('recipe_category', 'Recipe Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('recipe_category', 'Create Recipe Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'recipes_id',
            'description:ntext',
            'status',
            //'dt_add',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
