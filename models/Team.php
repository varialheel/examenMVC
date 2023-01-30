<?php
class Team {
    private $cod_team;
    private $name;
    private $cod_school;
    private $captain;

    public function __construct($cod_team = 0,$name="",$cod_school=0,$captain="")
    {
        $this->cod_team = $cod_team;
        $this->name = $name;
        $this->cod_school = $cod_school;
        $this->captain = $captain;
    }

	public function getCod_team() {
		return $this->cod_team;
	}

	public function setCod_team($cod_team) {
		$this->cod_team = $cod_team;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getCod_school() {
		return $this->cod_school;
	}

	public function setCod_school($cod_school) {
		$this->cod_school = $cod_school;
	}

	public function getCaptain() {
		return $this->captain;
	}

	public function setCaptain($captain) {
		$this->captain = $captain;
	}

}