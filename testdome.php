<?php
class LeagueTable
{
    protected $standings = [];

    public function __construct(array $players)
    {
        foreach ($players as $index => $p) {
            $this->standings[$p] = [
                'index'        => $index,
                'games_played' => 0,
                'score'        => 0
            ];
        }
    }

    public function recordResult(string $player, int $score): void
    {
        $this->standings[$player]['games_played']++;
        $this->standings[$player]['score'] += $score;        
    }

    public function playerRank(int $rank)
    {
        //var_dump($this->standings);
        $maxArray = [];
        $arrGamePlayed = array_column($this->standings, 'games_played');
        $arrScore = array_column($this->standings, 'score');
        $i=0;
        foreach ($this->standings as $stand){
            $maxArray[$i]['min'] = min($arrGamePlayed);
            $maxArray[$i]['max'] = max($arrScore);                         
            $i++;
        }
        var_dump($maxArray);
        //return '';
    }
}

$table = new LeagueTable(array('Mike', 'Chris', 'Arnold'));
$table->recordResult('Mike', 2);
$table->recordResult('Mike', 3);
$table->recordResult('Arnold', 5);
$table->recordResult('Chris', 5);
echo $table->playerRank(1);