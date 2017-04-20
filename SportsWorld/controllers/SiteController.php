<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url; 
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\NbaModel; 

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $email = "caseyjg@iastate.edu";
        $phone = "1234567890";
        return $this->render('about', [
            'email' => $email,
            'phone' => $phone
        ]);
    }

    //delete
    public function actionSpeak($message = "default message") { 
        return $this->render("speak",['message' => $message]); 
    } 

    //delete
    public function actionShowContactModel() {
        $mContactForm = new \app\models\ContactForm(); 
        $mContactForm->name = "contactForm"; 
        $mContactForm->email = "user@gmail.com"; 
        $mContactForm->subject = "subject"; 
        $mContactForm->body = "body"; 
        var_dump($mContactForm);
    }

    //delete
    public function actionTestGet() {
        var_dump(Yii::$app->request->headers);
    }

    //delete
    /*public function actionScores() {
        //$model = new \app\models\NBAModel(); 
        //$data = $model.getDailyGames();  

        //return $this->render('scores', ['data' => $data]);
        

        /*$ch = curl_init(); 

        curl_setopt($ch, CURLOPT_URL, 'https://www.mysportsfeeds.com/api/feed/pull/nba/2017-playoff/daily_game_schedule.json?fordate=20170416');

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

        curl_setopt($ch, CURLOPT_ENCODING, "gzip"); 

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode('casey' . ':' . 'portfolio3') 
            ));

        $data = curl_exec($ch); 
        curl_close($ch);
    }*/
}
