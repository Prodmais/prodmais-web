<?php

namespace app\controllers;

use Yii;
use app\models\Tasks;
use app\models\TasksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends Controller
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
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateAjax($id)
    {
        $model = new Tasks();
        $model->boardId = $id;
        $model->status = '1'; // do

        if (
            $model->load(Yii::$app->request->post()) &&
            $model->validate()
        ) {

            $url = 'https://'.HOST."/board/".$id.'/task';

            $data=[
                'name'=> $model->name,
                'description'=> $model->description,
                // 'endDate'=> '2222-10-10' .' '. '00:00:00.000 -0400',
                'status'=> $model->status
            ];
            $payload = json_encode( $data );
    
            $curl = curl_init($url);
    
            curl_setopt($curl, CURLOPT_URL, $url);
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
            // post
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
    
            // Prepare the authorisation token
            $authorization = "Authorization: Bearer ".\Yii::$app->session['jwt'];
            
            // Set the content type to application/json
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', $authorization));
            
            // Return response instead of outputting
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
            $resp = curl_exec($curl);
            curl_close($curl);
    
            // @DESC tornando o arquivo JSON para string
            $json_decode = json_decode($resp, true);

            // print_r($model);
            // print_r($json_decode);
            // die();

            return true;
        }

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateAjax($id)
    {
        $model = $this->findModel($id);
        $model->status = 2;

        if (
            $model->load(Yii::$app->request->post()) &&
            $model->validate()
        ) {

            $url = 'https://'.HOST.'/board/'.$model->boardId."/".$id;

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

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // @DESC finalizar tarefa
    public function actionAlterarStatus()
    {
        $id = $_POST['id'];

        $alterar = $this->findModel($id);

        $url = 'https://'.HOST.'/board/'.$alterar->boardId."/task/".$id;

        $data=[
            'name'=> $alterar->name,
            'description'=> $alterar->description,
            'status'=> $alterar->status == 'Doing' ? 1 : 2
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

    // @DESC excluir via ajax
    public function actionRemoverAjax()
    {
        $id = $_POST['id'];
        $remove = $this->findModel($id);

        $url = 'https://'.HOST.'/board/'.$remove->boardId."/task/".$id;

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
