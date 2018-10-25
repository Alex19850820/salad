<?php

namespace backend\modules\recipes\controllers;

use common\models\Debug;
use common\models\Ingredients;
use common\models\IngrToRecipes;
use Yii;
use backend\modules\recipes\models\Recipes;
use backend\modules\recipes\controllers\RecipesSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RecipesController implements the CRUD actions for Recipes model.
 */
class RecipesController extends Controller
{
	public $data = [];
	public $ingredients;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Recipes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecipesSearch();
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Recipes model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Recipes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Recipes();
	    foreach ($this->getIngredients() as $ingr) {
		    $this->data[$ingr->id] = $ingr->name;
	    }
	    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model, 'data' => $this->data,
        ]);
    }

    /**
     * Updates an existing Recipes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
//        $model->description = $model->getDescription();
	
	    foreach ($this->getIngredients() as $ingr ) {
		    $this->data[$ingr->id] = $ingr->name;
	    }
	   
	    $model->ingrToRecipes =  ArrayHelper::getColumn( IngrToRecipes::find()->where([ 'recipes_id' => $model->id])->all(), 'ingredients_id');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model, 'data' => $this->data,
        ]);
    }
	
	public function getIngredients () {
		$this->ingredients = Ingredients::find()->where(['!=', 'status', 0])->all();
		return $this->ingredients;
	}
    /**
     * Deletes an existing Recipes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Recipes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Recipes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Recipes::find()->where(['id'=>$id])->with('ingrToRecipes')->one()) !== null) {
        	return $model;
        }

        throw new NotFoundHttpException(Yii::t('recipes', 'The requested page does not exist.'));
    }
}
