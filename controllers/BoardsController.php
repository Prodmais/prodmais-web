<?php

namespace app\controllers;

use Yii;
use app\models\Boards;
use app\models\BoardsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Tasks;

/**
 * BoardsController implements the CRUD actions for Boards model.
 */
class BoardsController extends Controller
{
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
     * Lists all Boards models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BoardsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Boards model.
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
     * Creates a new Boards model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Boards();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Boards model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Boards model.
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
     * Finds the Boards model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Boards the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Boards::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // -----------------------------
    // -----------------------------
    // @DESC carrega os quadros do usuario
    public function actionMeus() {
        return $this->render('quadro-usuario/index');
    }

    // @DESC retorna todos os quadros do usuario
    public function actionAllQuadros() {

        $idLogged = yii::$app->user->identity->id;

        $dataQuadro = Boards::find()
        ->where(['userId' => $idLogged])
        ->all();

        foreach ($dataQuadro as $key => $value) {
            $dataQuadro[$key]['lista_tarefa'] =
            Tasks::find()
            ->where(['boardId' => $value->id])
            ->all();
        }

        // echo "<pre>". print_r($dataQuadro, 1) ."</pre>";
        // die();

        return $this->renderAjax('quadro-usuario/quadros', [
            'dataQuadro' => $dataQuadro
        ]);

    }

    // @DESC cadastrar via ajax
    public function actionCreateAjax()
    {
        $model = new Boards();
        $model->userId = yii::$app->user->identity->id;
        $model->isMobile = false;

        if (
            $model->load(Yii::$app->request->post()) &&
            $model->validate()
        ) {

            $url = 'https://'.HOST.'/board';

            $data=[
                'name'=> $model->name,
                'description'=> $model->description,
                'isMobile'=> $model->isMobile
            ];
            $payload = json_encode( $data );

            // Prepare the authorisation token
            $authorization = "Authorization: Bearer ".\Yii::$app->session['jwt'];
    
            $curl = curl_init($url);
    
            curl_setopt($curl, CURLOPT_URL, $url);
    
            // post
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            
            // Set the content type to application/json
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', $authorization));
            
            // Return response instead of outputting
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
            $resp = curl_exec($curl);
            curl_close($curl);
    
            // @DESC tornando o arquivo JSON para string
            $json_decode = json_decode($resp, true);

            return true;
        }

        return $this->renderAjax('quadro-usuario/form', [
            'model' => $model,
        ]);
    }

    // @DESC cadastrar via ajax
    public function actionUpdateAjax($id)
    {

        $model = $this->findModel($id);

        if (
            $model->load(Yii::$app->request->post()) &&
            $model->validate()
        ) {

            $url = 'https://'.HOST.'/board/'.$id;

            $data=[
                'name'=> $model->name,
                'description'=> $model->description
            ];
            $payload = json_encode( $data );

            $authorization = "Authorization: Bearer ".\Yii::$app->session['jwt']; // Prepare the authorisation token
    
            $curl = curl_init($url);
    
            curl_setopt($curl, CURLOPT_URL, $url);
    
            // post
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            
            // Set the content type to application/json
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', $authorization));
            
            // Return response instead of outputting
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
            $resp = curl_exec($curl);
            curl_close($curl);
    
            // @DESC tornando o arquivo JSON para string
            $json_decode = json_decode($resp, true);

            return true;
        }

        return $this->renderAjax('quadro-usuario/form', [
            'model' => $model,
        ]);
    }

    // @DESC excluir via ajax
    public function actionRemoverAjax()
    {
        $id = $_POST['id'];

        $url = 'https://'.HOST.'/board/'.$id;

        $authorization = "Authorization: Bearer ".\Yii::$app->session['jwt']; // Prepare the authorisation token

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_URL, $url);

        // post
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        
        // Set the content type to application/json
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', $authorization));
        
        // Return response instead of outputting
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($curl);
        curl_close($curl);

        // @DESC tornando o arquivo JSON para string
        $json_decode = json_decode($resp, true);

        return true;
    }
}
