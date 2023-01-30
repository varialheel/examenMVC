<?php
require_once "models/GamesModel.php";
require_once "models/TeamsModel.php";
require_once "views/GamesView.php";
class GamesController {
    private $model;
    private $view;
    public function __construct()
    {
        $teamModel = new TeamsModel();
        $this->view = new GamesView();
        $this->model = new GamesModel();
        showHeader($teamModel->listTeams(), $this->model->listCompetitions());
    }
    function listGames() {
            $this->view->listGamesView($this->model->listGames());
        
    }
}