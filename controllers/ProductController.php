<?php

namespace app\controllers;
use yii\web\UploadedFile;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use Yii;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if ((Yii::$app->user->isGuest) || (Yii::$app->user->identity->administrator==0)){
            $this->redirect(['site/login']);}

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCatalog()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('catalog', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Product model.
     * @param int $id_p Id P
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_p)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_p),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    public function actionCreate()
    {
        $model = new Product();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->img=UploadedFile::getInstance($model,'img');
            $file_name='/web/product_img/' . \Yii::$app->getSecurity()->generateRandomString(50). '.' . $model->img->extension;
            $model->img->saveAs(\Yii::$app->basePath . $file_name);
            $model->img=$file_name;

            if ( $model->save(false)) {
                return $this->redirect(['view', 'id_p' => $model->id_p]);

            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_p Id P
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->img=UploadedFile::getInstance($model,'image');
            $file_name='/web/product_img/' . \Yii::$app->getSecurity()->generateRandomString(50). '.' . $model->img->extension;
 $model->img->saveAs(\Yii::$app->basePath . $file_name);
 $model->img=$file_name;
 $model->save(false);
 return $this->redirect(['view', 'id' => $model->id_p]);
 }
        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_p Id P
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_p)
    {
        $this->findModel($id_p)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_p Id P
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_p)
    {
        if (($model = Product::findOne(['id_p' => $id_p])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
