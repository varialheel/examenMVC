<?php
class TeamsView
{
    function showTeam($team,$competition, $players,$deleted="")
    {
?>
        <section>
            <h1>Detalles del equipo: <?= $team->getName() ?></h1>
            <h2>Número de jugadores: <?= count($players) ?></h2>
            <h2>Nombre del capitán: <?= $team->getCaptain() ?></h2>
            <h2>Listado de jugadores:</h2>
            <?php
                if ($deleted!=="") {
                    if ($deleted[1]) {
                        ?>
                        <p>Participante borrado: <?=$deleted[0]?></p>
                        <?php
                    } else {
                        ?>
                        <p>Atención Participante: <?=$deleted[0]?> no se ha borrdado. Comprueba si está relacionado</p>
                        <?php
                    }
                    
                }
            ?>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($players as $value) {
                    ?>
                        <tr>
                            <td><?= $value->getId() ?></td>
                            <td><?= $value->getName() ?></td>
                            <td>
                                <form action="index.php?controller=Teams&action=deletePlayer" method="post">
                                    <input type="hidden" name="datas" value="<?=
                                    implode(";",array($team->getCod_team(),$competition,$value->getId()));
                                    ?>">
                                    <button type="submit">Borrar jugador.</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
<?php
    }
    function showCompetition($visitorGames,$localGames,$competition) {
        $wins = 0;
        $loses = 0;
        $ties = 0;
        ?>
            <h2>Competición seleccionada: <?= $competition ?></h2>
            <h3>Partidos jugados como equipo local en esta competición</h3>
            <table>
                <thead>
                    <tr>
                        <th>Cod Partido</th>
                        <th>Competición</th>
                        <th>Equipo Visitante</th>
                        <th>Pts Local</th>
                        <th>Pts Visitante</th>
                        <th>Fecha Partido</th>
                        <th>Ganador</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php
                    foreach ($localGames as $value) {
                        ?>
                            <tr>
                                <td><?= $value->getCod_game() ?></td>
                                <td><?= $value->getCompetition() ?></td>
                                <td><?= $value->getVisitor() ?></td>
                                <td><?= $value->getScore_local() ?></td>
                                <td><?= $value->getScore_visitor() ?></td>
                                <td><?= $value->getGame_date() ?></td>
                                <td><?php
                                    if ($value->getScore_local()===$value->getScore_visitor()) {
                                        $ties++;
                                        echo "Empate";
                                    } else if ($value->getScore_local()>$value->getScore_visitor()) {
                                        $wins++;
                                        echo $value->getLocal();
                                    } else {
                                        $loses++;
                                        echo $value->getVisitor();
                                    }
                                    
                                ?></td>
                            </tr>
                        <?php
                    }
                ?>
                </tbody>
            </table>
            <h3>Partidos jugados: <?=count($localGames) ?>, Victorias: <?= $wins ?>, Derrotas: <?= $loses ?>, Empates <?= $ties ?></h3>
            <h3>Partidos jugados como equipo visitante en esta competición</h3>
            <table>
                <thead>
                    <tr>
                        <th>Cod Partido</th>
                        <th>Competición</th>
                        <th>Equipo Local</th>
                        <th>Pts Local</th>
                        <th>Pts Visitante</th>
                        <th>Fecha Partido</th>
                        <th>Ganador</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $wins = 0;
                    $loses = 0;
                    $ties = 0;
                    foreach ($visitorGames as $value) {
                        ?>
                            <tr>
                                <td><?= $value->getCod_game() ?></td>
                                <td><?= $value->getCompetition() ?></td>
                                <td><?= $value->getLocal() ?></td>
                                <td><?= $value->getScore_local() ?></td>
                                <td><?= $value->getScore_visitor() ?></td>
                                <td><?= $value->getGame_date() ?></td>
                                <td><?php
                                    if ($value->getScore_local()===$value->getScore_visitor()) {
                                        $ties++;
                                        echo "Empate";
                                    } else if ($value->getScore_local()>$value->getScore_visitor()) {
                                        $loses++;
                                        echo $value->getLocal();
                                    } else {
                                        $wins++;
                                        echo $value->getVisitor();
                                    }
                                    
                                ?></td>
                            </tr>
                        <?php
                    }
                ?>
                </tbody>
            </table>
            <h3>Partidos jugados: <?=count($visitorGames) ?>, Victorias: <?= $wins ?>, Derrotas: <?= $loses ?>, Empates <?= $ties ?></h3>
        <?php
        
    }
}
