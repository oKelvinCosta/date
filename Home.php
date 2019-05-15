<?php
require "_app/config.php";

$_SESSION['ano'] = date("Y");



$Select = new Select;


// CANCELAMENTO automático do curso
// Manutenção de Qtd Alunos para inicio de curso

// 1 dia depois
//$day = date("Y-m-d", strtotime(date("Y-m-d")) + (60*60*24));
//
//$Select->exeSelect("cursos", "WHERE data_inicio = :data_atual AND alun_matriculado < qtd_min_alun", array('data_atual' => $day));
//
//$r = $Select->getRows();
//if($r > 0){
//    $id = $Select->getResultAssoc();
//    $id = $id['id_curso'];
//
//    $Update = new Update;
//    $Update->exeUpdate("cursos", "turma_cancelada = :cancel", "WHERE id_curso = :id", array('cancel'=> 1, 'id'=> $id));
//}








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

    <link rel="stylesheet" href="css/Home.css?">
    <link rel="stylesheet" href="css/Menu.css">
    <link rel="stylesheet" href="css/General.css">
    <link rel="stylesheet" href="css/Footer.css">

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
            <nav class="orientador">
                <div class="container clearfix">
                    <ul class="title">
                        <li id="container_pager">

                            <?php
                            $Select->exeSelect("anos", "WHERE ano = :ano", array('ano' => $_SESSION['ano']));
                            $PagerAtual = $Select->getResultAssoc();
                            $PagerAtual = $PagerAtual['id_ano'];

                            $Pager = new Paginacao;
                            $Pager->setPagincao($PagerAtual, 1, 'beforeH', 'afterH');

                            $Select->exeSelect('anos', "LIMIT :limit OFFSET :offset", array('limit' => $Pager->getLimit(), 'offset' => $Pager->getOffset()));
                            $Pager->dadosTabela('anos');

                            // Pagincação
                            echo $Pager->before();

                            while ($Ano = $Select->getResultAssoc()) {
                                ?>
                                <span><?= $Ano['ano']; ?></span>
                                <?php
                                $_SESSION['ano'] = $Ano['ano'];
                            }

                            // Pagincação
                            echo $Pager->after();

                            ?>

                            <!--                        --><?php
                            //                        if (isset($_SESSION['error'])) {
                            //                            echo @$_SESSION['error'];
                            //                        }
                            //                        if (isset($_SESSION['sucess'])) {
                            //                            echo @$_SESSION['sucess'];
                            //                        }
                            //                        ?>
                        </li>
                    </ul>

                    <!--ALAVANCA-->
                    <input type="checkbox" hidden id="toggle_pesq">
                    <!--FIM ALAVANCA-->

                    <label class="pesq_x" for="toggle_pesq"></label>

                    <ul class="pesq">
                        
                        <li>
                            <form action="Home.php" method="post" id="MyFormH">

                                <input class="input" name="text" id="textH" type="text" required placeholder="Pesquisar Curso">

                                <select class="input" name="categoria" id="catH">
                                    <option value="">Categoria de curso</option>
                                    <option value="6">Aperfeiçoamento</option>
                                    <option value="3">Aprendizagem</option>
                                    <option value="5">Iniciação</option>
                                    <option value="4">Livre</option>
                                    <option value="2">Qualificação</option>
                                    <option value="1">Técnico</option>
                                </select>

                                <select class="input" name="estado" id="estH">
                                    <option value="">Estado do curso</option>
                                    <option value="1">A iniciar</option>
                                    <option value="2">Andamento</option>
                                    <option value="3">Terminado</option>
                                    <option value="4">Cancelado</option>
                                </select>

                            </form>
                        </li>
                    </ul>
                </div>

                <div id="legenda" class="container">
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

        <section id="calendar" class="calendar container clearfix">

            <?php



            $Select->exeSelect("meses");

            require "Parts/Home_Conteudo.php";
            ?>
        </section>

        <?php
        require "Parts/Footer.php";
        ?>
    </div>

    <div id="modal"></div>
    <div id="modal_2"></div>


    <script src="js/PagHome.js" type="text/javascript"></script>
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

</body>
</html>
