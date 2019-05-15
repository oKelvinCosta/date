<?php


require "../../_app/config.php";

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$Pcat = $post['categoria'];
$Ptext = $post['text'];
$Pestado = $post['estado'];

$Select = new Select;
$Select->exeSelect("meses");

while ($Res = $Select->getResultAssoc()) {
    ?>

    <div class="square box">
        <header class="clearfix">
            <h2><?= $Res['mes']; ?></h2>

            <?php
            if($_SESSION['user']['permicao'] != 3){
                ?>
                <a href="Calendar.php?mes=<?= $Res['id_mes']; ?>" class="img_calendar"></a>
                <?php
            }
            ?>

        </header>

        <ul>

            <?php

            $Cursos = new Select;

            // Coloca 0 antes do número
            if ($Res['id_mes'] < 10) {
                $mes = '0' . $Res['id_mes'];
            } else {
                $mes = $Res['id_mes'];
            }

            // Cálculo ano Bissexto
            if ($_SESSION['ano'] % 4 == 0 AND $mes == '02') {
                $Res['dias'] = 29;
            }

            $Cursos->exeSelect("cursos",
                multPesquisa(2, $_SESSION['ano'], $mes, $Res['dias'],$Ptext, $Pcat, $Pestado),
                multPesquisa(1, $_SESSION['ano'], $mes, $Res['dias'],$Ptext, $Pcat, $Pestado)
            );


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
                                <span <?= $styleColor; ?> class="nomeCurso"
                                                          data-curso_id-type="<?= $C['id_curso']; ?>"><?= $C['nome']; ?></span>
                                <a class="download" href="Uploads/Plano_de_Curso/<?= $C['plano'];?>" download="" title="Download Plano de Curso"></a>
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
                                <span class="nomeCurso"
                                      data-curso_id-type="<?= $C['id_curso']; ?>"><?= $C['nome']; ?></span>

                                <a class="download" href="Uploads/Plano_de_Curso/<?= $C['plano'];?>" download="" title="Download Plano de Curso"></a>
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


function multPesquisa($Contexto, $Ano, $Mes, $Dias, $Text = null, $Categoria = null, $Estado = null)
{

    $Termos = "WHERE data_inicio >= :data_inicio AND data_inicio <= :data_final AND status = :status";
    $Array = array('data_inicio' => $Ano . '-' . $Mes . '-01', 'data_final' => $Ano . '-' . $Mes . '-' . $Dias, 'status' => 1);

    if (!empty($Categoria)) {
        $Termos .= ' AND tipo = :tipo';
        $Array = array_merge($Array, array('tipo' => $Categoria));
    }

    if (!empty($Text)) {
        $Termos .= ' AND nome LIKE :like';
        $Array = array_merge($Array, array('like' => $Text));
    }

    switch ($Estado) {
        // A iniciar
        case 1:
            $Termos .= ' AND data_inicio >= :data_atual AND turma_cancelada != :cancelado';
            $Array = array_merge($Array, array('data_atual' => date("Y-m-d"), 'cancelado' => 1));
            break;
        // Andamentto
        case 2:
            $Termos .= ' AND data_final >= :data_atual AND data_inicio <= :data_atual AND turma_cancelada != :cancelado';
            $Array = array_merge($Array, array('data_atual' => date("Y-m-d"), 'cancelado' => 1));
            break;
        // Terminado
        case 3:
            $Termos .= ' AND data_final <= :data_atual';
            $Array = array_merge($Array, array('data_atual' => date("Y-m-d")));
            break;
        case 4:
            $Termos .= ' AND turma_cancelada = :cancelado';
            $Array = array_merge($Array, array('cancelado' => 1));
            break;
    }

    if ($Contexto == 1) {
        return $Array;
    } elseif ($Contexto == 2) {
        return $Termos;
    }

}

