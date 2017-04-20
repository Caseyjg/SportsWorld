<?php

namespace app\models;

use Yii;
use yii\base\Model;
use linslin\yii2\curl; 

/**
 * ContactForm is the model behind the contact form.
 */
class NbaModel extends Model
{
    public $result;

    public function getDailyGames() {
        $ch = curl_init(); 

        curl_setopt($ch, CURLOPT_URL, 'https://www.mysportsfeeds.com/api/feed/pull/nba/2017-playoff/daily_game_schedule.json?fordate=20170416');

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

        curl_setopt($ch, CURLOPT_ENCODING, "gzip"); 

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode('casey' . ':' . 'portfolio3') 
            ));

        //$result = curl_exec($ch); 
        curl_exec($ch);

        curl_close($ch); 

        //$result = json_decode($result, TRUE); 
    }

}
