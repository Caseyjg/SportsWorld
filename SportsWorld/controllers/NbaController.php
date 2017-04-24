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

    	$ppgLeaders = $model->getPlayoffPPGLeaders(); 

    	$astLeaders = $model->getPlayoffAstLeaders(); 

    	$rebLeaders = $model->getPlayoffRebLeaders(); 

    	return $this->render('scores', ['data' => $scores, 'ppgLeaders' => $ppgLeaders, 'astLeaders' => $astLeaders, 'rebLeaders' => $rebLeaders]);
    }

    //regular season action
}
