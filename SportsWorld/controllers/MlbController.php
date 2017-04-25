<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url; 

use yii\web\Controller;

use app\models\MlbModel;

class MlbController extends Controller
{
    public function actionSeason() {
    	$model = new MlbModel(); 

    	$games = $model->getDailyGames(); 

    	$standings = ($model->getDivisionStandings());

    	return $this->render('scores', ['games' => $games, 'standings' => $standings]);

    }
}
