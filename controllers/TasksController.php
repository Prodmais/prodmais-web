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

            $url = HOST."/board/".$id.'/task';

            $data=[
                'name'=> $model->name,
                'description'=> $model->description,
                'status'=> $model->status
            ];

            // removend campos vazios
            $data = array_filter( $data, 'strlen' );   

            $payload = json_encode( $data );
    
            $curl = curl_init($url);
    
            curl_setopt($curl, CURLOPT_URL, $url);
    
            // post
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
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
        $model->status = $this->converteStatus($model->status);

        if (
            $model->load(Yii::$app->request->post()) &&
            $model->validate()
        ) {

            $url = HOST.'/board/'.$model->boardId."/task/".$id;

            $data=[
                'name'=> $model->name,
                'description'=> $model->description,
                'status'=> $model->status,
            ];
            // removend campos vazios
            $data = array_filter( $data, 'strlen' );   
            
            $payload = json_encode( $data );

            $authorization = "Authorization: Bearer ".\Yii::$app->session['jwt']; // Prepare the authorisation token

            $curl = curl_init($url);
    
            curl_setopt($curl, CURLOPT_URL, $url);
    
            // put
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

            // @DESC se for done entao exibe mensagem
            if ($model->status == 3) {
                \Yii::$app->getSession()->setFlash('info', \Yii::$app->Messages->getMessage());
            }

            return true;
            
        }

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }

    // @DESC convert status nominal para numerico
    private function converteStatus($status) {

        switch ($status) {
            case 'Do':
                $status = 1;
                break;
            case 'Doing':
                $status = 2;
                break;
            case 'Done':
                $status = 3;
                break;
            default:
                $status = 1;
                break;
        }
        
        return $status;
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

    // @DESC excluir via ajax
    public function actionRemoverAjax()
    {
        $id = $_POST['id'];
        $remove = $this->findModel($id);

        $url = HOST.'/board/'.$remove->boardId."/task/".$id;

        $authorization = "Authorization: Bearer ".\Yii::$app->session['jwt']; // Prepare the authorisation token

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_URL, $url);

        // delete
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
