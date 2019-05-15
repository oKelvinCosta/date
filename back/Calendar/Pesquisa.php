<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 11/01/2017
 * Time: 14:02
 */

require "../../_app/config.php";

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);


$Pcat = $post['categoria'];
$PnumDia = $post['numDia'];
$Ptext = $post['text'];
$PdiaSemana = $post['diaSemana'];
$Pestado = $post['estado'];

// Selecionad e acordo com o mes
$mesSelect = new Select;
$mesSelect->exeSelect("meses", "WHERE id_mes = :id", array('id' => $_SESSION['mesCalendar']));

$i = 1;
$Res = $mesSelect->getResultAssoc();

// Classe para manipular a data
$DataManip = new Data_Manipulacao;


// Se a pessoa pesquisar por dia
if (!empty($PnumDia)) {

    $DataManip->setData($PnumDia, $Res['id_mes']);

    ?>
    <!--ROW DIA-->
    <div class="programacao clearfix">
        <!--DIA-->
        <div class="dia">
            <span class="dia_number"><?= $DataManip->getDia(); ?></span>
            <span class="dia_semana"><?= $DataManip->getDataSemana(); ?></span>
        </div>
        <!--FIM DIA-->
        <!--BOXES-->
        <ul>
            <?php
            // LOOP nos cursos do dia
            $Curso = new Select;

            // Data do dia do loop, não a a atual
            $Curso->exeSelect("cursos",
                multPesquisaCalendar(2, $DataManip->getData(), $DataManip->getDataDiaSemana(), $Ptext, $Pcat, $Pestado),
                multPesquisaCalendar(1, $DataManip->getData(), $DataManip->getDataDiaSemana(), $Ptext, $Pcat, $Pestado)
            );


            while ($C = $Curso->getResultAssoc()) {

                // Mostrar Curso Terminado Apagado
                if ($C['data_final'] <= date("Y-m-d")) {

                    $styleBg = "background-color: #f7f7f7;";
                    $styleColor = "color: #d6d6d6;";

                } else {
                    $styleBg = "";
                    $styleColor = "";
                }

                ?>

                <li style="<?= $styleBg; ?>" class="box clearfix infoBoxCurso"
                    data-curso_id-type="<?= $C['id_curso']; ?>">
                    <a target="_blank" href="Info_Curso.php?idCurso=<?= $C['id_curso']; ?>">
                        <div>
                            <div style="<?= $styleColor; ?>" class="curso"><?= $C['nome']; ?></div>
                            <div>

                                <?php
                                switch ($C['turno']) {
                                    case 1:
                                        echo "<span style='color: #fbbc05; " . $styleColor . "' class=\"hora\"> " . $C['horario'] . "</span>";
                                        break;
                                    case 2:
                                        echo "<span style='color: #fe7c47; " . $styleColor . "' class=\"hora\"> " . $C['horario'] . "</span>";
                                        break;
                                    case 3:
                                        echo "<span style='color: #4e69dd; " . $styleColor . "' class=\"hora\"> " . $C['horario'] . "</span>";
                                        break;
                                }
                                ?>

                                <span class="status">

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

                                        </span>
                            </div>
                        </div>
                    </a>
                </li>
                <?php


            }
            ?>
        </ul>
        <!--FIM BOXES-->
    </div>
    <!--FIM ROW DIA-->
    <?php

} else {

// Loop na quantidade de dias que o mês tem
    for ($i = 1; $i <= $Res['dias']; $i++) {

        $DataManip->setData($i, $Res['id_mes']);

        // Se pesquisar Dia Semana
        if ((!empty($PdiaSemana) OR $PdiaSemana == 0) AND ($PdiaSemana != null OR $PdiaSemana != "")) {

            if ($PdiaSemana == $DataManip->getDataDiaSemana()) {

                // LISTAR CURSOS DENTRO DOS DIAS
                ?>
                <!--ROW DIA-->
                <div class="programacao clearfix">
                    <!--DIA-->
                    <div class="dia">
                        <span class="dia_number"><?= $DataManip->getDia(); ?></span>
                        <span class="dia_semana"><?= $DataManip->getDataSemana(); ?></span>
                    </div>
                    <!--FIM DIA-->
                    <!--BOXES-->
                    <ul>
                        <?php
                        // LOOP nos cursos do dia
                        $Curso = new Select;

                        // Data do dia do loop, não a a atual
                        $Curso->exeSelect("cursos",
                            multPesquisaCalendar(2, $DataManip->getData(), $DataManip->getDataDiaSemana(), $Ptext, $Pcat, $Pestado),
                            multPesquisaCalendar(1, $DataManip->getData(), $DataManip->getDataDiaSemana(), $Ptext, $Pcat, $Pestado)
                        );


                        while ($C = $Curso->getResultAssoc()) {

                            // Mostrar Curso Terminado Apagado
                            if ($C['data_final'] <= date("Y-m-d")) {

                                $styleBg = "background-color: #f7f7f7;";
                                $styleColor = "color: #d6d6d6;";

                            } else {
                                $styleBg = "";
                                $styleColor = "";
                            }

                            ?>

                            <li style="<?= $styleBg; ?>" class="box clearfix infoBoxCurso"
                                data-curso_id-type="<?= $C['id_curso']; ?>">
                                <a target="_blank" href="Info_Curso.php?idCurso=<?= $C['id_curso']; ?>">
                                    <div>
                                        <div style="<?= $styleColor; ?>" class="curso"><?= $C['nome']; ?></div>
                                        <div>

                                            <?php
                                            switch ($C['turno']) {
                                                case 1:
                                                    echo "<span style='color: #fbbc05; " . $styleColor . "' class=\"hora\"> " . $C['horario'] . "</span>";
                                                    break;
                                                case 2:
                                                    echo "<span style='color: #fe7c47; " . $styleColor . "' class=\"hora\"> " . $C['horario'] . "</span>";
                                                    break;
                                                case 3:
                                                    echo "<span style='color: #4e69dd; " . $styleColor . "' class=\"hora\"> " . $C['horario'] . "</span>";
                                                    break;
                                            }
                                            ?>

                                            <span class="status">

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

                                        </span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <?php


                        }
                        ?>
                    </ul>
                    <!--FIM BOXES-->
                </div>
                <!--FIM ROW DIA-->
                <?php
            }

            // Se Nome
        } else {
            // LISTAR CURSOS DENTRO DOS DIAS
            ?>
            <!--ROW DIA-->
            <div class="programacao clearfix">
                <!--DIA-->
                <div class="dia">
                    <span class="dia_number"><?= $DataManip->getDia(); ?></span>
                    <span class="dia_semana"><?= $DataManip->getDataSemana(); ?></span>
                </div>
                <!--FIM DIA-->
                <!--BOXES-->
                <ul>
                    <?php
                    // LOOP nos cursos do dia
                    $Curso = new Select;

                    // Data do dia do loop, não a a atual
                    $Curso->exeSelect("cursos",
                        multPesquisaCalendar(2, $DataManip->getData(), $DataManip->getDataDiaSemana(), $Ptext, $Pcat, $Pestado),
                        multPesquisaCalendar(1, $DataManip->getData(), $DataManip->getDataDiaSemana(), $Ptext, $Pcat, $Pestado)
                    );


                    while ($C = $Curso->getResultAssoc()) {

                        // Mostrar Curso Terminado Apagado
                        if ($C['data_final'] <= date("Y-m-d")) {

                            $styleBg = "background-color: #f7f7f7;";
                            $styleColor = "color: #d6d6d6;";

                        } else {
                            $styleBg = "";
                            $styleColor = "";
                        }

                        ?>

                        <li style="<?= $styleBg; ?>" class="box clearfix infoBoxCurso"
                            data-curso_id-type="<?= $C['id_curso']; ?>">
                            <a target="_blank" href="Info_Curso.php?idCurso=<?= $C['id_curso']; ?>">
                                <div>
                                    <div style="<?= $styleColor; ?>" class="curso"><?= $C['nome']; ?></div>
                                    <div>

                                        <?php
                                        switch ($C['turno']) {
                                            case 1:
                                                echo "<span style='color: #fbbc05; " . $styleColor . "' class=\"hora\"> " . $C['horario'] . "</span>";
                                                break;
                                            case 2:
                                                echo "<span style='color: #fe7c47; " . $styleColor . "' class=\"hora\"> " . $C['horario'] . "</span>";
                                                break;
                                            case 3:
                                                echo "<span style='color: #4e69dd; " . $styleColor . "' class=\"hora\"> " . $C['horario'] . "</span>";
                                                break;
                                        }
                                        ?>

                                        <span class="status">

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

                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <?php


                    }
                    ?>
                </ul>
                <!--FIM BOXES-->
            </div>
            <!--FIM ROW DIA-->
        <?php }


    }
}


function multPesquisaCalendar($Contexto, $Data, $DiaSemana, $Text = null, $Categoria = null, $Estado = null)
{

    //  Ver se em cada dia tem um curso entre essas datas
    $Termos = "WHERE (data_final >= :data) AND (:data >= data_inicio) AND status = :status";
    $Array = array('data' => $Data, 'status' => 1);



    if (!empty($Text)) {
        $Termos .= ' AND nome LIKE :like';
        $Array = array_merge($Array, array('like' => $Text));
    }

    if (!empty($Categoria)) {
        $Termos .= ' AND tipo = :tipo';
        $Array = array_merge($Array, array('tipo' => $Categoria));
    }

    if ( $DiaSemana == 0 OR !empty($DiaSemana) ) {
        $Termos .= ' AND id_dias LIKE :like2';
        $Array = array_merge($Array, array('like2' => $DiaSemana));
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


