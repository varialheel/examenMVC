<?php

class GamesView {
    function listGamesView($games) {
        ?>
        <h1>Partidos Liga Escolar</h1>
        <h2>Número de partidos: <?=count($games)?></h2>
        <table>
            <thead>
                <tr>
                    <th>CodPartido</th>
                    <th>Competición</th>
                    <th>Equipo Local</th>
                    <th>Equipo Visitante</th>
                    <th>Pts Local</th>
                    <th>Pts Visitante</th>
                    <th>Fecha del Partido</th>
                    <th>Ganador</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($games as $value) {
                        ?>
                            <tr>
                                <td><?= $value->getCod_game() ?></td>
                                <td><?= $value->getCompetition() ?></td>
                                <td><?= $value->getLocal() ?></td>
                                <td><?= $value->getVisitor() ?></td>
                                <td><?= $value->getScore_local() ?></td>
                                <td><?= $value->getScore_visitor() ?></td>
                                <td><?= $value->getGame_date() ?></td>
                                <td><?php
                                    if ($value->getScore_local()===$value->getScore_visitor()) {
                                        echo "Empate";
                                    } else if ($value->getScore_local()>$value->getScore_visitor()) {
                                        echo $value->getLocal();
                                    } else {
                                        echo $value->getVisitor();
                                    }
                                    
                                ?></td>
                            </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
        <?php
    }
}