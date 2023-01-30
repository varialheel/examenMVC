<?php
class Game {
    private $cod_game;
    private $competition;
    private $local;
    private $visitor;
    private $score_local;
    private $score_visitor;
    private $game_date;

    public function __construct($cod_game=0,$competition="",$local=0,$visitor=0,$score_local=0,$score_visitor=0,$game_date="")
    {
        $this->cod_game = $cod_game;
        $this->competition = $competition;
        $this->local = $local;
        $this->visitor = $visitor;
        $this->score_local = $score_local;
        $this->score_visitor = $score_visitor;
        $this->game_date = $game_date;
    }

	public function getCod_game() {
		return $this->cod_game;
	}

	public function setCod_game($cod_game) {
		$this->cod_game = $cod_game;
	}

	public function getCompetition() {
		return $this->competition;
	}

	public function setCompetition($competition) {
		$this->competition = $competition;
	}

	public function getLocal() {
		return $this->local;
	}

	public function setLocal($local) {
		$this->local = $local;
	}

	public function getVisitor() {
		return $this->visitor;
	}

	public function setVisitor($visitor) {
		$this->visitor = $visitor;
	}

	public function getScore_local() {
		return $this->score_local;
	}

	public function setScore_local($score_local) {
		$this->score_local = $score_local;
	}

	public function getScore_visitor() {
		return $this->score_visitor;
	}

	public function setScore_visitor($score_vistor) {
		$this->score_visitor = $score_vistor;
	}

	public function getGame_date() {
		return $this->game_date;
	}

	public function setGame_date($game_date) {
		$this->game_date = $game_date;
	}

}