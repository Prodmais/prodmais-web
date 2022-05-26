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

    protected function findModel($id)
    {
        if (($model = Boards::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionIndex_old() {
        return $this->render('quadro-usuario/index');
    }

    // -----------------------------
    // -----------------------------
    // @DESC carrega os quadros do usuario
    // public function actionMeus() {
    //     return $this->render('quadro-usuario/index');
    // }

    // @DESC retorna todos os quadros do usuario
    public function actionIndex() {

        // @DESC id do usuario logado
        $idLogged = yii::$app->user->identity->id;

        // @DESC encontra todos os boards do usuario logado
        $dataQuadro = Boards::find()
        ->select(['id', 'name', 'isMobile'])
        ->where(['userId' => $idLogged])
        ->all();

        // @DESC encontra todos as tasks do usuario logado baseado no board
        foreach ($dataQuadro as $key => $value) {
            $dataQuadro[$key]['lista_tarefa'] =
            Tasks::find()
            ->select(['id', 'name', 'status'])
            ->where(['boardId' => $value->id])
            ->orderBy(['status' => SORT_ASC])
            ->all();
        }


        // print '<pre>';
        //     print_r($dataQuadro);
        // print '<pre>';
        // die();


        return $this->render('quadro-usuario/index', [
            'dataQuadro' => $dataQuadro
        ]);

    }

    // @DESC cadastrar via ajax
    public function actionCreateAjax()
    {

        $model = new Boards();
        $model->userId = yii::$app->user->identity->id;
        // $model->isMobile = false;

        if (
            $model->load(Yii::$app->request->post()) &&
            $model->validate()
        ) {

            $url = HOST.'/board';

            $data=[
                'name'=> $model->name,
                'description'=> $model->description,
                'isMobile'=> false
            ];

            // removend campos vazios
            $data = array_filter( $data, 'strlen' );        

            $payload = json_encode( $data );


            // Prepare the authorisation token
            $authorization = "Authorization: Bearer ".\Yii::$app->session['jwt'];
            
            $curl = curl_init($url);
    
            curl_setopt($curl, CURLOPT_URL, $url);
    
            // post
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
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

            $url = HOST.'/board/'.$id;

            $data=[
                'name'=> $model->name,
                'description'=> $model->description
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

        $model = $this->findModel($id);

        // @DESC nao deixar excluir se for mobile
        if (isset($model) && $model->isMobile) {
            return true;
        }

        $url = HOST.'/board/'.$id;

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
