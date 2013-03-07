<?php

/* 
 * EloRating PHP Class
 * License: MIT License - http://www.opensource.org/licenses/mit-license.php
 * Documentation: http://www.github.com
 * Description: Simple class for using and calculating Elo Ratings
 * Author: Tushar Dhoot - http://tushardhoot.com
*/

class EloRating {
	
	// Result Constants
	// 1 is WIN, 2 is LOSS, anything else is TIE
	const ELO_RESULT_WIN = 1;
	const ELO_RESULT_LOSS = 2;
	const ELO_RESULT_TIE = 0;
	
	// Default rating
	// The rating all players start at.
	const ELO_RATING_DEFAULT = 1500;
	
	// Protected properties. Use functions below to get & set.
	protected $rating1;
	protected $rating2;
	protected $score1;
	protected $score2;
	protected $k = 50;
	
	public function __construct($rating1 = ELO_RATING_DEFAULT, $rating2 = ELO_RATING_DEFAULT) {
		$this->rating1 = $rating1;
		$this->rating2 = $rating2;
	}
	
	// setResult($result)
	// Call when you want to update the ratings (after a game, etc.)
	// $result = ELO_RESULT_WIN or ELO_RESULT_LOSS or ELO_RESULT_TIE
	public function setResult($result) {
		$score1 = computeScore($this->rating2, $this->rating1);
		$score2 = computeScore($this->rating1, $this->rating2);
		if ($result == ELO_RESULT_WIN) {
			$this->rating1 = $this->rating1 + ($this->computeK($this->rating1) * (1 - $score1));
			$this->rating2 = $this->rating2 + ($this->computeK($this->rating2) * (0 - $score2));
		} elseif ($result == ELO_RESULT_LOSS) {
			$this->rating1 = $this->rating1 + ($this->computeK($this->rating1) * (0 - $score1);
			$this->rating2 = $this->rating2 + ($this->computeK($this->rating2) * (1 - $score2));
		} else {
			// Assume tie
			$this->rating1 = $this->rating1 + ($this->computeK($this->rating1) * (0.5 - $score1));
			$this->rating2 = $this->rating2 + ($this->computeK($this->rating2) * (0.5 - $score2));
		}
	}
	
	protected function computeScore($rating1, $rating2) {
	        return (1 / (1 + pow(10, ($rating1 - $rating2) / 400)));
	}
	
	// computeK($rating)
	// K-value determines the mobility of ratings (the maximum change
	// in rating per game). Feel free to edit this function to return
	// different K-values based on the player's rating.
	// Default K-value is 50
	protected function computeK($rating) {
		return $k;
	}
	
	public function getScore1() {
                $this->score1 = computeScore($this->rating2, $this->rating1);
		return $this->score1;
	}
	
	public function getScore2() {
                $this->score2 = computeScore($this->rating1, $this->rating2);
		return $this->score2;
	}
	
	public function getRating1() {
		return $this->rating1;
	}
	
	public function getRating2() {
		return $this->rating2;
	}
}

?>
