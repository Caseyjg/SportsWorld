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
    public function getPlayoffGames() {
        $ch = curl_init(); 

        $date = getdate(); 
        if($date['mon'] < 10)
            $date['mon'] = '0' . $date['mon'];
        if($date['mday'] < 10)
            $date['mday'] = '0' . $date['mday'];

        $date = $date['year'] . $date['mon'] . $date['mday']; 

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

        $toReturn = ""; 
        $i = 0; 
        for($i = 0; $i < count($arr); $i++) {
            $toReturn .= $arr[$i]->awayTeam->Name . '<br/>';
        }

        return $arr; 
    }

    public function getPlayoffStats() {
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

        $result = curl_exec($ch); 

        curl_close($ch); 

        $result = json_decode($result); 
        return $result->cumulativeplayerstats->playerstatsentry; 

        //$result = json_decode($result, true); 
        //return $result; 

        //$arr = $result->dailygameschedule->gameentry;
    }

    /*public function getPlayoffStats() {
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

        $result = curl_exec($ch); 

        curl_close($ch); 

        $result = json_decode($result); 

        //return $result->cumulativeplayerstats->playerstatsentry; 
        $stats = $result->cumulativeplayerstats->playerstatsentry;
        $numTeams = 0; 
        $teams = array(); 

        for($row = 0; $row < count($stats); $row++) {
            $team = $stats[$row]->team->Name;
            if(!in_array($team, $teams)) {
                $teams[]=$team; 
            }
        }

        $teamStats = array(); 

        for($row = 0; $row < count($teams); $row++) {
            $count = 0; 
            for($col = 0; $col < count($stats); $col++) {
                if($stats[$col]->team->Name == $teams[$row]) {
                    $teamStats[$row][$count] = $stats[$col];
                }
            }
        }

        return $teamStats; 
    }*/

}
