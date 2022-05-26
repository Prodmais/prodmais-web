<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Pessoa;
// use app\models\Quadro;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'only' => ['logout'],
    //             'rules' => [
    //                 [
    //                     'actions' => ['logout'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'logout' => ['post'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        // $idLogged = yii::$app->user->identity->pess_codigo;

        // $dataQuadro = Quadro::find()
        // ->where(['quad_habilitado' => 1])
        // ->andWhere(['pess_codigo' => $idLogged])
        // ->all();

        // return $this->render('index',[
        //         // 'dataQuadro' => $dataQuadro
        //     ]
        // );

        Yii::$app->getResponse()->redirect(["/boards"])->send();

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'blank_login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            $this->geToken($model);

            Yii::$app->getResponse()->redirect(["/boards"])->send();
        }

        $model->password = '';
        return $this->render('n_login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        \Yii::$app->session->remove('jwt');

        Yii::$app->getResponse()->redirect(['/site/login'])->send();
    }

    // @DESC recebendo o token JWT
    private function geToken($model) {

        $url = HOST.'/login';

        $data=[
            'email'=> $model->name,
            'password'=> $model->password
        ];
        $payload = json_encode( $data );

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_URL, $url);
        // post
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        $resp = curl_exec($curl);
        curl_close($curl);

        // @DESC tornando o arquivo JSON para string
        $json_decode = json_decode($resp, true);

        if (isset($json_decode['token'])) {
            \Yii::$app->session['jwt'] = $json_decode['token'];
        }

    }

}
