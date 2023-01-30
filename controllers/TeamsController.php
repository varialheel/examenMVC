<?php
require_once "models/GamesModel.php";
require_once "models/TeamsModel.php";
require_once "models/PlayersModel.php";
require_once "views/TeamsView.php";
class TeamsController {
    private $model;
    private $view;
    private $playersModel;
    private $GameModel;
    public function __construct()
    {
        $this->GameModel = new GamesModel();
        $this->view = new TeamsView();
        $this->model = new TeamsModel();
        $this->playersModel = new PlayersModel();
    }
    function getTeam() {
        $datas = filter_input_array(INPUT_POST);
        if (isset($datas)) {
            showHeader($this->model->listTeams(), $this->GameModel->listCompetitions(),$datas["team"],$datas["competition"]);
            if(count($team = $this->model->getTeam($datas["team"]))>0){
                $this->view->showTeam($team[0],$datas["competition"],$this->playersModel->getPlayers($datas["team"]));
                $this->view->showCompetition($this->GameModel->listVisitorGames($team[0]->getCod_team(),$datas["competition"]),$this->GameModel->listLocalGames($team[0]->getCod_team(),$datas["competition"]),$datas["competition"]);
            }
        } else {
            header("Location:index.php");
        }
        
    }
    function deletePlayer() {
        $datas = explode(";",filter_input(INPUT_POST,"datas"));
        if (isset($datas)) {
            showHeader($this->model->listTeams(), $this->GameModel->listCompetitions(),$datas[0],$datas[1]);
            if (count($this->model->getCaptain($datas[2]))>0) {
                $this->view->showTeam($this->model->getTeam($datas[0])[0],$datas[1],$this->playersModel->getPlayers($datas[0]),[$datas[2],false]);
            } else {
                $deleted = $this->playersModel->deletePlayer($datas[2]);
                $this->view->showTeam($this->model->getTeam($datas[0])[0],$datas[1],$this->playersModel->getPlayers($datas[0]),[$datas[2],$deleted]);
            }
            $this->view->showCompetition($this->GameModel->listVisitorGames($datas[0],$datas[1]),$this->GameModel->listLocalGames($datas[0],$datas[1]),$datas[1]);
        } else {
            header("Location:index.php");
        }
        
    }
}