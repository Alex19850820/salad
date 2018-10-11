<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\recipes\controllers\RecipesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('recipes', 'Recipes');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="recipes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('recipes', 'Create Recipes'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			
			'id',
			'name',
			'description:ntext',
			'status',
			'slug',
			//'dt_add',
			
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
