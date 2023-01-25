<?php

namespace app\controllers;
use app\models\Product;
use app\models\Cart;
use app\models\CartSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Cart models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CartSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cart model.
     * @param int $id_cr Id Cr
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_cr)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_cr),
        ]);
    }
    public function beforeAction($action){
        if ($action->id=='create') $this->enableCsrfValidation=false;
        return parent::beforeAction($action);
    }
    /**
     * Creates a new Cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
            $id_product = Yii::$app->request->post('id_product');
            $items=Yii::$app->request->post('count');
            $product = Product::findOne($id_product);
                if (!$product) return false;
                if ($product->count > 0) {
                    $product->count -= $items;
                    $product->save(false);
                    $model = cart::find()->where(['id_user' => Yii::$app->user->identity->id])->andWhere(['id_product' => $id_product])->one();
                    if ($model)
                    {
                         $model->count += $items;
                         $model->save();
                         return $product->count;
                    }
                    $model = new cart();
                    $model->id_user= Yii::$app->user->identity->id;
                    $model->id_product = $product->id_p;
                    $model->count = $items;
         if ($model->save(false)) return $product->count;
         }
                return 'false';
            }


        /* $model = new Cart();

         if ($this->request->isPost) {
             if ($model->load($this->request->post()) && $model->save()) {
                 return $this->redirect(['view', 'id_cr' => $model->id_cr]);
             }
         } else {
             $model->loadDefaultValues();
         }

         return $this->render('create', [
             'model' => $model,
         ]);

      * Updates an existing Cart model.
      * If update is successful, the browser will be redirected to the 'view' page.
      * @param int $id_cr Id Cr
      * @return string|\yii\web\Response
      * @throws NotFoundHttpException if the model cannot be found
      */



    public function actionUpdate($id_cr)
    {
        $model = $this->findModel($id_cr);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_cr' => $model->id_cr]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_cr Id Cr
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_cr)
    {
        $this->findModel($id_cr)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_cr Id Cr
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_cr)
    {
        if (($model = Cart::findOne(['id_cr' => $id_cr])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
