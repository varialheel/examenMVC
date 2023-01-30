<?php
function showHeader($teams, $competitions, $teamId = "", $competitionName = "")
{
?>
    <header>
        <p>Examen PHP-POO-MVC. Oscar Garcia Dorado</p>
        <p></p>
        <p><?= date('F j Y h:i A') ?></p>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Examen</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Index <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="post" action="index.php?controller=Teams&action=getTeam">
                    <label for="">Selecciona un equipo y una competición</label>
                    <select name="team" id="">
                        <?php
                        foreach ($teams as $team) {
                            if ($team->getCod_team() == $teamId) {

                        ?>
                                <option value="<?= $team->getCod_team() ?>" selected><?= $team->getName() ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="<?= $team->getCod_team() ?>"><?= $team->getName() ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <select name="competition" id="">
                        <?php
                        foreach ($competitions as $competition) {
                            if ($competition["COMPETICION"]==$competitionName) {
                                ?>
                            <option value="<?= $competition["COMPETICION"] ?>" selected><?= $competition["COMPETICION"] ?></option>
                        <?php
                            } else {
                                ?>
                            <option value="<?= $competition["COMPETICION"] ?>"><?= $competition["COMPETICION"] ?></option>
                        <?php
                            }
                            
                        
                        }
                        ?>
                    </select>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ver datos</button>
                </form>
            </div>
        </nav>
    </header>
<?php
}
