<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url; 

use yii\web\Controller;

use app\models\NbaModel;

//only for the playoffs
class NbaController extends Controller
{
    public function actionPlayoffs() {
    	$model = new NbaModel();  

    	$scores = $model->getPlayoffGames();

    	$stats = $model->getPlayoffStats(); 

    	//echo print_r($stats); 

    	return $this->render('scores', ['data' => $scores, 'stats' => $stats]);
    }

    //regular season action
}
