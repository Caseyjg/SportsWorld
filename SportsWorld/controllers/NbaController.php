<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url; 

use yii\web\Controller;

use app\models\NbaModel;

class NbaController extends Controller
{

    //delete
    public function actionScores() {
    	$model = new NbaModel();  
        return $this->render('scores', ['data' => $model->getDailyGames()]);
        //return $this->render('scores'); 
    }
}
