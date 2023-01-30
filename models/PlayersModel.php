<?php
require_once "bd/Bd.php";
require_once "Player.php";
class PlayersModel {
    function getPlayers($team) {
        $players = [];
        try {
            $bd = new Bd();
            $result = $bd->select("SELECT `COD_PARTICIPANTE`,`NOMBRE` FROM `taparticipantes` where `COD_EQUIPO` = ?",[$team]);
            foreach ($result as $value) {
                array_push($players, new Player($value["COD_PARTICIPANTE"],$value["NOMBRE"]));
            }
        } catch (Exception $th) {
            echo $th->getMessage();
        }
        return $players;
    }
    function deletePlayer($id) {
        try {
            $bd = new Bd();
            return $bd->consulta("DELETE FROM `taparticipantes` WHERE `COD_PARTICIPANTE` = ?",[$id]);
            
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
}