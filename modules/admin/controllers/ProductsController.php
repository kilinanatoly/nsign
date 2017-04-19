<?php

namespace app\modules\admin\controllers;

use app\models\Ingridients;
use app\models\IngridientsForProducts;
use Yii;
use app\models\Products;
use app\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'admin';
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
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $current_ingridients = IngridientsForProducts::find()->where('product_id = '.$id.'')->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'currentIngridients' => $current_ingridients,
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()){
                if (Yii::$app->request->post('ingridients')){
                    foreach (Yii::$app->request->post('ingridients') as $key => $value) {
                        $ingridient_for_products_model = new IngridientsForProducts();
                        $ingridient_for_products_model->ingridient_id = $value;
                        $ingridient_for_products_model->product_id = $model->id;
                        $ingridient_for_products_model->save();
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $allIngridients = Ingridients::find()->where('active = 1')->orderBy('id DESC')->all();
            return $this->render('create', [
                'model' => $model,
                'allIngridients' => $allIngridients,
            ]);
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            IngridientsForProducts::deleteAll(['product_id'=>$id]);
            if (Yii::$app->request->post('ingridients')){
                foreach (Yii::$app->request->post('ingridients') as $key => $value) {
                    $ingridient_for_products_model = new IngridientsForProducts();
                    $ingridient_for_products_model->ingridient_id = $value;
                    $ingridient_for_products_model->product_id = $model->id;
                    $ingridient_for_products_model->save();
                }
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $allIngridients = Ingridients::find()->where('active = 1')->orderBy('id DESC')->all();
            $currentIngridients_tmp = IngridientsForProducts::find()->where('product_id = '.$id.'')->all();
            foreach ($currentIngridients_tmp as $key=>$value) {
                $currentIngridients[] = $value->ingridient_id;
            }

            return $this->render('update', [
                'model' => $model,
                'allIngridients' => $allIngridients,
                'currentIngridients' => isset($currentIngridients )? $currentIngridients : [],
            ]);
        }
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
