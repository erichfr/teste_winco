<?php
class LeagueTable {
    private $players = [];

    public function __construct($players) {
        foreach ($players as $player) {
            $this->players[$player] = ['points' => 0, 'matches' => 0];
        }
    }

    public function recordResult($playerName, $points) {
        $this->players[$playerName]['points'] += $points;
        $this->players[$playerName]['matches'] += 1;
    }

    public function playerRank($rank) {
        uasort($this->players, function($a, $b) {
            if ($a['points'] != $b['points']) {
                return $b['points'] - $a['points'];
            } elseif ($a['matches'] != $b['matches']) {
                return $a['matches'] - $b['matches'];
            } else {
                return array_search($a, array_values($this->players)) + array_search($b, array_values($this->players));
            }
        });
    
        $sortedPlayers = array_keys($this->players);
        return $sortedPlayers[$rank - 1];
    }
}

$table = new LeagueTable(['Mike', 'Chris', 'Arnold']);
$table->recordResult('Mike', 2);
$table->recordResult('Mike', 3);
$table->recordResult('Arnold', 5);
$table->recordResult('Chris', 5);
echo $table->playerRank(1);