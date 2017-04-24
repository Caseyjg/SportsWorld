<?php

namespace app\models;

use Yii;
use yii\base\Model;
use linslin\yii2\curl; 

class NhlModel extends Model
{
    private function curlInit() {

    	/*


		
		TODO !!!!!!!!!!!!!! TODO



    	*/
        $ch = curl_init(); 

        $date = getdate(); 
        if($date['mon'] < 10)
            $date['mon'] = '0' . $date['mon'];
        if($date['mday'] < 10)
            $date['mday'] = '0' . $date['mday'];

        $date = $date['year'] . $date['mon'] . $date['mday']; 

        curl_setopt($ch, CURLOPT_URL, "https://www.mysportsfeeds.com/api/feed/pull/mlb/2017-regular/cumulative_player_stats.json?playerstats=AB,H,R,HR,ER");

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

        curl_setopt($ch, CURLOPT_ENCODING, "gzip"); 

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode('casey' . ':' . 'portfolio3') 
            ));

        return curl_exec($ch);

    }

    private function getList() {
        $result = $this->curlInit(); 
        $result = json_decode($result, true); 
        return $result['cumulativeplayerstats']['playerstatsentry'];
    }

    public function getDailyGames() {
        $ch = curl_init(); 

        $date = getdate(); 
        if($date['mon'] < 10)
            $date['mon'] = '0' . $date['mon'];
        if($date['mday'] < 10)
            $date['mday'] = '0' . $date['mday'];

        $date = $date['year'] . $date['mon'] . $date['mday']-1; 

        curl_setopt($ch, CURLOPT_URL, 'https://www.mysportsfeeds.com/api/feed/pull/nhl/2017-playoff/daily_game_schedule.json?fordate=' . $date);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

        curl_setopt($ch, CURLOPT_ENCODING, "gzip"); 

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode('casey' . ':' . 'portfolio3') 
            ));

        $result = curl_exec($ch); 

        curl_close($ch); 

        $result = json_decode($result);

        return $result->dailygameschedule->gameentry;; 
    }
}
