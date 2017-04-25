<?php

namespace app\models;

use Yii;
use yii\base\Model;
use linslin\yii2\curl; 

class NhlModel extends Model
{
	public function getDailyPlayoffGames() {
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

        $result = json_decode($result, true);

        if(array_key_exists('gameentry', $result['dailygameschedule']))
            return $result['dailygameschedule']['gameentry'];
        else 
            return -1; 
    }

    private function curlInit() {
        $ch = curl_init(); 

        $date = getdate(); 
        if($date['mon'] < 10)
            $date['mon'] = '0' . $date['mon'];
        if($date['mday'] < 10)
            $date['mday'] = '0' . $date['mday'];

        $date = $date['year'] . $date['mon'] . $date['mday']; 

        curl_setopt($ch, CURLOPT_URL, "https://www.mysportsfeeds.com/api/feed/pull/nhl/2017-playoff/cumulative_player_stats.json?playerstats=G,A,Pts,Sh");

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

    public function getPlayoffGoalLeaders() {
        $list = $this->getList(); 
        usort($list, array($this, 'sortByGoals'));
        return array_slice($list, 0, 5); 
    }

    public function getPlayoffAssistLeaders() {
        $list = $this->getList(); 
        usort($list, array($this, 'sortByAssists'));
        return array_slice($list, 0, 5); 
    }

    public function getPlayoffPointLeaders() {
        $list = $this->getList(); 
        usort($list, array($this, 'sortByPoints'));
        return array_slice($list, 0, 5); 
    }

    private function sortByGoals($obj1, $obj2) {
        if($obj2['stats']['stats']['Goals']['#text'] < $obj1['stats']['stats']['Goals']['#text'])
            return -1; 
        else if($obj2['stats']['stats']['Goals']['#text'] > $obj1['stats']['stats']['Goals']['#text'])
            return 1; 
        else
            return 0; 
    }

    private function sortByAssists($obj1, $obj2) {
        if($obj2['stats']['stats']['Assists']['#text'] < $obj1['stats']['stats']['Assists']['#text'])
            return -1; 
        else if($obj2['stats']['stats']['Assists']['#text'] > $obj1['stats']['stats']['Assists']['#text'])
            return 1; 
        else
            return 0; 
    }

    private function sortByPoints($obj1, $obj2) {
        if($obj2['stats']['stats']['Points']['#text'] < $obj1['stats']['stats']['Points']['#text'])
            return -1; 
        else if($obj2['stats']['stats']['Points']['#text'] > $obj1['stats']['stats']['Points']['#text'])
            return 1; 
        else
            return 0; 
    }
}
