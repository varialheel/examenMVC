<?php
require_once "bd/Bd.php";
require_once "Team.php";
class TeamsModel {
    function listTeams() {
        $teams = [];
        try {
            $bd = new Bd();
            $result = $bd->select("SELECT taequipos.`COD_EQUIPO`,concat(taequipos.`COD_EQUIPO`,' - ',`NOM_EQUIPO`) as nombre,`COD_CENTRO`, NOMBRE as capitan FROM `taequipos` INNER JOIN taparticipantes on CAPITAN = COD_PARTICIPANTE
            ");
            foreach ($result as $value) {
                array_push($teams, new Team($value["COD_EQUIPO"],$value["nombre"],$value["COD_CENTRO"],$value["capitan"]));
            }
        } catch (Exception $th) {
            echo $th->getMessage();
        }
        return $teams;
    }
    function getTeam($id) {
        $team = [];
        try {
            $bd = new Bd();
            $result = $bd->select("SELECT taequipos.`COD_EQUIPO`,concat(taequipos.`COD_EQUIPO`,' - ',`NOM_EQUIPO`) as nombre,`COD_CENTRO`, NOMBRE as capitan FROM `taequipos` INNER JOIN taparticipantes on CAPITAN = COD_PARTICIPANTE WHERE taequipos.COD_EQUIPO=?
            ",[$id]);
            foreach ($result as $value) {
                array_push($team, new Team($value["COD_EQUIPO"],$value["nombre"],$value["COD_CENTRO"],$value["capitan"]));
            }
        } catch (Exception $th) {
            echo $th->getMessage();
        }
        return $team;
    }
    function getCaptain($id) {
        $team = [];
        try {
            $bd = new Bd();
            $result = $bd->select("SELECT taequipos.`COD_EQUIPO`,`NOM_EQUIPO`,`COD_CENTRO`, NOMBRE as capitan FROM `taequipos` INNER JOIN taparticipantes on CAPITAN = COD_PARTICIPANTE WHERE taequipos.capitan=?
            ",[$id]);
            foreach ($result as $value) {
                array_push($team, new Team($value["COD_EQUIPO"],$value["NOM_EQUIPO"],$value["COD_CENTRO"],$value["capitan"]));
            }
        } catch (Exception $th) {
            echo $th->getMessage();
        }
        return $team;
    } 
}