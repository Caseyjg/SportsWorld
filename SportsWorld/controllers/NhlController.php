<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url; 

use yii\web\Controller;

use app\models\NhlModel;

class NhlController extends Controller
{
    public function actionSeason() {
    	$model = new NhlModel(); 

    	$games = $model->getDailyPlayoffGames(); 

    	$goals = $model->getPlayoffGoalLeaders();

    	$assists = $model->getPlayoffAssistLeaders(); 

    	$points = $model->getPlayoffPointLeaders(); 

    	return $this->render('scores', ['games' => $games, 'goals' => $goals, 'assists' => $assists, 'points' => $points]);
    }
}
