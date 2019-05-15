<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 17/02/2017
 * Time: 15:08
 */


while ($Res = $Select->getResultAssoc()) {
    ?>

    <div class="square box">
        <header class="clearfix">
            <h2><?= $Res['mes']; ?></h2>
            <?php
            if ($_SESSION['user']['permicao'] != 3) {
                ?>
                <a href="Calendar.php?mes=<?= $Res['id_mes']; ?>" class="img_calendar"></a>
                <?php
            }
            ?>
        </header>

        <ul>

            <?php

            $Cursos = new Select;
            $Cursos->exeSelect("cursos", "WHERE data_inicio > :ano AND status = :status", array('ano' => $_SESSION['ano'] . '-01-01', 'status' => 1));

            // Coloca 0 antes do número
            if ($Res['id_mes'] < 10) {
                $mes = '0' . $Res['id_mes'];
            } else {
                $mes = $Res['id_mes'];
            }

            // Data Y-m
            $data = $_SESSION['ano'] . '-' . $mes;

            while ($C = $Cursos->getResultAssoc()) {

                // Só mostra o curso no mês em qeue ele se inicia
                if (date("Y-m", strtotime($C['data_inicio'])) == $data) {

                    // Mostrar Curso Terminado Apagado
                    if ($C['data_final'] <= date("Y-m-d")) {
                        $styleBg = "style='background-color: #f7f7f7;'";
                        $styleColor = "style='color: #d6d6d6;'";
                        ?>
                        <li <?= $styleBg; ?>>
                            <a style="cursor: default" href="#">

                                <span style='background-color: #d6d6d6' class='point'></span>
                                <span <?= $styleColor; ?> class="nomeCurso" title="<?= $C['nome'];?>" data-curso_id-type="<?= $C['id_curso']; ?>">
                                    <?php
                                    echo Auxiliares::Words( $C['nome'], 4, '...');
                                    ?>
                                </span>
                                <a class="download" href="Uploads/Plano_de_Curso/<?= $C['plano'];?>" download="" title="Download Plano de Curso. <?= $C['nome'];?>"></a>
                            </a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li>
                            <a target="_blank" href="Info_Curso.php?idCurso=<?= $C['id_curso']; ?>">

                                <?php

                                if ($C['turma_cancelada'] == 1) {
                                    echo "<span style='background-color: #ff2b41' class='point'></span>";
                                } else if ($C['data_final'] >= date("Y-m-d") AND $C['data_inicio'] <= date("Y-m-d")) {
                                    echo "<span style='background-color: #4285f4' class='point'></span>";
                                } elseif ($C['data_final'] <= date("Y-m-d")) {
                                    echo "<span style='background-color: #f2f2f2' class='point'></span>";
                                } elseif ($C['data_inicio'] >= date("Y-m-d")) {
                                    echo "<span style='background-color: #1dc462' class='point'></span>";
                                }
                                ?>
                                <span class="nomeCurso" title="<?= $C['nome'];?>"
                                      data-curso_id-type="<?= $C['id_curso']; ?>">

                                <?php
                                echo Auxiliares::Words( $C['nome'], 4, '...');
                                ?>
                                </span>
                                <a class="download" href="Uploads/Plano_de_Curso/<?= $C['plano'];?>" download="" title="Download Plano de Curso. <?= $C['nome'];?>"></a>
                            </a>

                        </li>
                        <?php
                    }
                    ?>
                    <?php
                }
            }

            ?>
        </ul>
    </div>

    <?php
}
?>