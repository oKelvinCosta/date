<?php
require "_app/config.php";

$get = filter_input_array(INPUT_GET, FILTER_VALIDATE_INT);
if (empty($get)) {
    $get['mes'] = (int)date("m");
}
$_SESSION['mesCalendar'] = $get['mes'];

if (empty($_SESSION['ano'])) {
    $_SESSION['ano'] = date("Y");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Date | Calendário de Cursos!</title>
    <meta name="keywords" content="date, senai, cecoteg, cursos, agendamento, calendario">
    <meta name="description" content="date, um site calendário para seus cursos!">
    <meta name="author" content="Kelvin Costa">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/General.css">


    <link rel="stylesheet" href="css/Calendar.css">
    <link rel="stylesheet" href="css/Menu.css">
    <link rel="stylesheet" href="css/Footer.css">
    <link rel="stylesheet" href="css/Home.css">
    <link rel="stylesheet" href="css/General.css">

    <!--    <link rel="stylesheet" href="css/Modal.css">-->

    <?php
    switch ($_SESSION['user']['permicao']) {
        case 1:
            ?>
            <link rel="stylesheet" href="css/Form.css">
            <?php
            break;
        default:
            ?>
            <?php
    }
    ?>
    <style>
        /*POINTS ESTADO*/

        .point {
            display: inline-block;
            height: 10px;
            width: 10px;
            background-color: #484848;
            margin-bottom: 0px;
            margin-left: 5px;
            margin-right: 0;
        }

        /* fim POINTS ESTADO*/
    </style>

</head>
<body>

<div id="tudo">
    <div class="space_top">
        <header>
            <!--HEADER NAV MENU-->
            <?php
            require "Parts/Header_Menu.php";
            ?>
            <!--FIM HEADER NAV MENU-->


            <!--NAV AUXILIAR-->

            <nav class="orientador calendar_detail">
                <div class="container clearfix">
                    <ul class="title">
                        <li id="container_pager_ano">


                            <?php

                            // Coincidir select ano com seu id para com a page atual
                            $AnoSelect = new Select;
                            $AnoSelect->exeSelect("anos", "WHERE ano = :ano", array('ano' => $_SESSION['ano']));
                            $PageAtual = $AnoSelect->getResultAssoc();
                            $PageAtual = $PageAtual['id_ano'];


                            $PagerAno = new Paginacao;
                            $PagerAno->setPagincao($PageAtual, 1, 'before', 'after');

                            $AnoSelect->exeSelect("anos", "LIMIT :limit OFFSET :offset", array('limit' => $PagerAno->getLimit(), 'offset' => $PagerAno->getOffset()));

                            $PagerAno->dadosTabela("anos");
                            $AnoResult = $AnoSelect->getResultAssoc();

                            echo $PagerAno->before();
                            ?>
                            <span><?= $AnoResult['ano']; ?></span>
                            <?= $PagerAno->after(); ?>


                        </li>
                        <li id="container_pager_mes">

                            <?php
                            $PagerMes = $PagerAno;
                            $mesSelect = $AnoSelect;

                            $PagerMes->setPagincao($_SESSION['mesCalendar'], 1, 'beforeMes', 'afterMes');

                            $mesSelect->exeSelect("meses", "LIMIT :limit OFFSET :offset", array('limit' => $PagerMes->getLimit(), 'offset' => $PagerMes->getOffset()));

                            $PagerMes->dadosTabela("meses");
                            $mesResult = $mesSelect->getResultAssoc();

                            echo $PagerMes->before();
                            ?>
                            <span><?= $mesResult['mes']; ?></span>
                            <?= $PagerMes->after(); ?>


                        </li>
                    </ul>

                    <label class="pesq_x" for="toggle_pesq">
                    </label>

                    <!--ALAVANCA-->
                    <input type="checkbox" hidden id="toggle_pesq">
                    <!--FIM ALAVANCA-->

                    <ul class="pesq">


                        <li>
                            <form action="Home.php" method="post" id="MyFormC">

                                <input class="input" name="text" id="textC" type="text" required placeholder="Pesquisar Curso">

                                <select class="input" name="categoria" id="catC">
                                    <option value="">Categoria de curso</option>
                                    <option value="6">Aperfeiçoamento</option>
                                    <option value="3">Aprendizagem</option>
                                    <option value="5">Iniciação</option>
                                    <option value="4">Livre</option>
                                    <option value="2">Qualificação</option>
                                    <option value="1">Técnico</option>
                                </select>

                                <select class="input" name="estado" id="estC">
                                    <option value="">Estado do curso</option>
                                    <option value="1">A iniciar</option>
                                    <option value="2">Andamento</option>
                                    <option value="3">Terminado</option>
                                    <option value="4">Cancelado</option>
                                </select>

                                <input class="input" type="number" id="numDiaC" name="numDia" placeholder="Dia">


                                <select class="input" name="diaSemana" id="diaSemanaC">
                                    <option value="">Dia Semana</option>
                                    <option value="0">Domingo</option>
                                    <option value="1">Segunda-feira</option>
                                    <option value="2">Terça-feira</option>
                                    <option value="3">Quarta-feira</option>
                                    <option value="4">Quinta-feira</option>
                                    <option value="5">Sexta-feira</option>
                                    <option value="6">Sábado</option>
                                </select>

                            </form>
                        </li>
                    </ul>

                    <label class="box toggle_pesq" for="toggle_pesq">
                        <img src="img/searcher.png" alt="">
                    </label>

                </div>

                <div class="container" id="legenda">
                    <ul>
                        <li>
                            <span class="pointl"></span>
                            A iniciar
                        </li>
                        <li>
                            <span class="pointl"></span>
                            Andamento
                        </li>
                        <li>
                            <span class="pointl"></span>
                            Terminado
                        </li>
                        <li>
                            <span class="pointl"></span>
                            Cancelado
                        </li>
                    </ul>
                </div>

            </nav>
            <!--FIM NAV AUXILIAR-->
        </header>

        <section class="container" id="container_dias">

            <?php


            // Seleciona de acordo com o mes
            $mesSelect->exeSelect("meses", "WHERE id_mes = :id", array('id' => $_SESSION['mesCalendar']));


            $i = 1;
            $Res = $mesSelect->getResultAssoc();

            // Loop na quantidade de dias que o mês tem
            for ($i = 1; $i <= $Res['dias']; $i++) {


                // Coloca 0 antes do número
                if ($Res['id_mes'] < 10) {
                    $mes = '0' . $Res['id_mes'];
                } else {
                    $mes = $Res['id_mes'];
                }

                // Y-m-d
                $data = $_SESSION['ano'] . '-' . $mes . '-' . $i;
                // Y-m
                $dataAnoMes = $_SESSION['ano'] . '-' . $mes;
                $getDate = getdate(strtotime($data));
                $getDate = $getDate['wday'];
                $Semana = array("Domingo", "Segunda-feira", "Terça-feita", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");
                $diaSemana = $Semana[$getDate];
                ?>

                <!--ROW DIA-->
                <div class="boxT programacao clearfix">
                    <!--DIA-->
                    <div class="dia">
                        <span class="dia_number"><?= $i; ?></span>
                        <span class="dia_semana"><?= $diaSemana; ?></span>
                    </div>
                    <!--FIM DIA-->

                    <!--BOXES-->
                    <ul>

                        <?php
                        // LOOP nos cursos do dia
                        $Curso = new Select;


                        // #### Especificar mais o select para não pesar ####
                        // Mostra os cursos que tem nos dias da semana $getDate muda conforme muda o LOOP dos dias
                        // Data do dia do loop, não a a atual
                        $Curso->exeSelect("cursos", "WHERE data_final >= :data AND :data >= data_inicio AND id_dias LIKE :like AND status = :status ORDER by turno, data_inicio", array('like' => $getDate, 'data' => $data, 'status' => 1));

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

                                    <div>
                                        <?php
                                        if($C['data_final'] >= date("Y-m-d")){
                                        ?>
                                        <a target="_blank" href="Info_Curso.php?idCurso=<?= $C['id_curso']; ?>">
                                            <?php
                                            }
                                            ?>
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
            ?>
    </div>

    </section>


    <?php
    require "Parts/Footer.php";
    ?>
</div>

<div id="modal"></div>
<div id="modal_2"></div>

<script src="js/Notificacoes.js" type="text/javascript"></script>
<script src="js/Menu.js" type="text/javascript"></script>
<?php
switch ($_SESSION['user']['permicao']) {
    case 1:
        ?>
        <script src="js/PagManutencao.js" type="text/javascript"></script>
        <?php
        break;
    default:
        ?>
        <?php
}
?>
<script src="js/PagCalendar.js" type="text/javascript"></script>

</body>
</html>