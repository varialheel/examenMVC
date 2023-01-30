<?php
require_once "bd/Bd.php";
require_once "Game.php";
class GamesModel {
    function listGames() {
        $partidos = [];
        try {
            $bd = new Bd();
            $result = $bd->select("SELECT `COD_PARTIDO`,`COMPETICION`,concat(COD_VISITANTE,' - ',LOCAL.NOM_EQUIPO) as eqLocal,concat(COD_VISITANTE,' - ',visitante.NOM_EQUIPO) as eqVisitante,`PUNTOSLOCAL`,`PUNTOSVISITANTE`,`FECHAPARTIDO` FROM `tapartidos` INNER JOIN taequipos as local on `COD_LOCAL`= LOCAL.COD_EQUIPO INNER JOIN taequipos as visitante on `COD_VISITANTE` = visitante.COD_EQUIPO ORDER BY COD_PARTIDO");
            foreach ($result as $value) {
                array_push($partidos, new Game($value["COD_PARTIDO"],$value["COMPETICION"],$value["eqLocal"],$value["eqVisitante"],$value["PUNTOSLOCAL"],$value["PUNTOSVISITANTE"],$value["FECHAPARTIDO"]));
            }
        } catch (Exception $th) {
            echo $th->getMessage();
        }
        return $partidos;
    }
    function listCompetitions() {
        $result = [];
        try {
            $bd = new Bd();
            $result = $bd->select("SELECT DISTINCT `COMPETICION` from tapartidos");
        } catch (Exception $th) {
            echo $th->getMessage();
        }
        return $result;
    }
    function listLocalGames($id,$competition) {
        $partidos = [];
        try {
            $bd = new Bd();
            $result = $bd->select("SELECT `COD_PARTIDO`,`COMPETICION`,concat(COD_VISITANTE,' - ',LOCAL.NOM_EQUIPO) as eqLocal,concat(COD_VISITANTE,' - ',visitante.NOM_EQUIPO) as eqVisitante,`PUNTOSLOCAL`,`PUNTOSVISITANTE`,`FECHAPARTIDO` FROM `tapartidos` INNER JOIN taequipos as local on `COD_LOCAL`= LOCAL.COD_EQUIPO INNER JOIN taequipos as visitante on `COD_VISITANTE` = visitante.COD_EQUIPO WHERE COD_LOCAL = ? AND COMPETICION = ? ORDER BY COD_PARTIDO",[$id,$competition]);
            foreach ($result as $value) {
                array_push($partidos, new Game($value["COD_PARTIDO"],$value["COMPETICION"],$value["eqLocal"],$value["eqVisitante"],$value["PUNTOSLOCAL"],$value["PUNTOSVISITANTE"],$value["FECHAPARTIDO"]));
            }
        } catch (Exception $th) {
            echo $th->getMessage();
        }
        return $partidos;
    }
    
    function listVisitorGames($id,$competition) {
        $partidos = [];
        try {
            $bd = new Bd();
            $result = $bd->select("SELECT `COD_PARTIDO`,`COMPETICION`,concat(COD_LOCAL,' - ',LOCAL.NOM_EQUIPO) as eqLocal,concat(COD_VISITANTE,' - ',visitante.NOM_EQUIPO) as eqVisitante,`PUNTOSLOCAL`,`PUNTOSVISITANTE`,`FECHAPARTIDO` FROM `tapartidos` INNER JOIN taequipos as local on `COD_LOCAL`= LOCAL.COD_EQUIPO INNER JOIN taequipos as visitante on `COD_VISITANTE` = visitante.COD_EQUIPO WHERE COD_VISITANTE = ? AND COMPETICION = ? ORDER BY COD_PARTIDO",[$id,$competition]);
            foreach ($result as $value) {
                array_push($partidos, new Game($value["COD_PARTIDO"],$value["COMPETICION"],$value["eqLocal"],$value["eqVisitante"],$value["PUNTOSLOCAL"],$value["PUNTOSVISITANTE"],$value["FECHAPARTIDO"]));
            }
        } catch (Exception $th) {
            echo $th;
        }
        return $partidos;
    }
}