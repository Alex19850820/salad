<?php

namespace backend\modules\ingredients\controllers;

use common\models\Property;
use common\models\PropertyConnIngredients;
use Yii;
use backend\modules\ingredients\models\Ingredients;
use backend\modules\ingredients\controllers\IngredientsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IngredientsController implements the CRUD actions for Ingredients model.
 */
class IngredientsController extends Controller
{
	
	public $data = [];
	public $property;
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
     * Lists all Ingredients models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IngredientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ingredients model.
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
     * Creates a new Ingredients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function getProperty () {
	    $this->property = Property::find()->where(['!=', 'status', 0])->all();
	    return $this->property;
    }
    
    
    public function actionCreate()
    {
        $model = new Ingredients();
        
	    foreach ($this->getProperty() as $prop ) {
		    $this->data[$prop->id] = $prop->name;
	    }
	    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model, 'data' => $this->data,
        ]);
    }

    /**
     * Updates an existing Ingredients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
	    foreach ($this->getProperty() as $prop ) {
		    $this->data[$prop->id] = $prop->name;
	    }
	    $model->propertyConnIngredients =  ArrayHelper::getColumn( PropertyConnIngredients::find()->where([ 'ingredients_id' => $model->id])->all(), 'property_id');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model, 'data' => $this->data,
        ]);
    }

    /**
     * Deletes an existing Ingredients model.
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
     * Finds the Ingredients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ingredients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ingredients::find()->where(['id'=>$id])->with('propertyConnIngredients')->one()) !== null) {
        	return $model;
        }

        throw new NotFoundHttpException(Yii::t('ingredients', 'The requested page does not exist.'));
    }
}
