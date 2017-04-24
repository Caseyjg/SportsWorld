<?php

namespace app\models;

use Yii;
use yii\base\Model;
use linslin\yii2\curl; 

class NbaModel extends Model
{
    public function getPlayoffGames() {
        $ch = curl_init(); 

        $date = getdate(); 
        if($date['mon'] < 10)
            $date['mon'] = '0' . $date['mon'];
        if($date['mday'] < 10)
            $date['mday'] = '0' . $date['mday'];

        $date = $date['year'] . $date['mon'] . $date['mday']-1; 

        curl_setopt($ch, CURLOPT_URL, 'https://www.mysportsfeeds.com/api/feed/pull/nba/2017-playoff/daily_game_schedule.json?fordate=' . $date);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

        curl_setopt($ch, CURLOPT_ENCODING, "gzip"); 

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode('casey' . ':' . 'portfolio3') 
            ));

        $result = curl_exec($ch); 

        curl_close($ch); 

        $result = json_decode($result); 

        $arr = $result->dailygameschedule->gameentry;

        return $arr; 
    }

    private function curlInit() {
        $ch = curl_init(); 

        $date = getdate(); 
        if($date['mon'] < 10)
            $date['mon'] = '0' . $date['mon'];
        if($date['mday'] < 10)
            $date['mday'] = '0' . $date['mday'];

        $date = $date['year'] . $date['mon'] . $date['mday']; 

        curl_setopt($ch, CURLOPT_URL, 'https://www.mysportsfeeds.com/api/feed/pull/nba/2017-playoff/cumulative_player_stats.json');

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

    public function getPlayoffPPGLeaders() {
        $list = $this->getList(); 
        usort($list, array($this, 'sortByPPG'));
        return array_slice($list, 0, 5); 
    }

    public function getPlayoffAstLeaders() {
        $list = $this->getList(); 
        usort($list, array($this, 'sortByAssist'));
        return array_slice($list, 0, 5);
    }

    public function getPlayoffRebLeaders() {
        $list = $this->getList();
        usort($list, array($this, 'sortByRebounds'));
        return array_slice($list, 0, 5);
    }


    private function sortByPPG($obj1, $obj2) {
        return $obj2['stats']['PtsPerGame']['#text'] - $obj1['stats']['PtsPerGame']['#text']; 
    }

    private function sortByAssist($obj1, $obj2) {
        return $obj2['stats']['AstPerGame']['#text'] - $obj1['stats']['AstPerGame']['#text']; 
    }

    private function sortByRebounds($obj1, $obj2) {
        return $obj2['stats']['RebPerGame']['#text'] - $obj1['stats']['RebPerGame']['#text']; 
    }

}
