<?php
require "_app/config.php";

$_SESSION['ano'] = date("Y");
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
    <link rel="stylesheet" href="css/General.css?att5">

    <link rel="stylesheet" href="css/Home.css?att4">
    <link rel="stylesheet" href="css/Menu.css">
    <link rel="stylesheet" href="css/General.css?att5">
    <link rel="stylesheet" href="css/Footer.css">

    <link rel="stylesheet" href="css/Manutencao_Cursos.css">


    <link rel="stylesheet" href="css/Form.css">

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

                        $Select = new Select;
                        $Select->exeSelect("anos", "WHERE ano = :ano", array('ano' => $_SESSION['ano']));
                        $PagerAtual = $Select->getResultAssoc();
                        $PagerAtual = $PagerAtual['id_ano'];

                        $Pager = new Paginacao;
                        $Pager->setPagincao($PagerAtual, 1, 'before', 'after');

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

                    </li>
                </ul>
                <label class="pesq_x" for="toggle_pesq">
                </label>
                <!--ALAVANCA-->
                <input type="checkbox" hidden id="toggle_pesq">
                <!--FIM ALAVANCA-->
                <ul class="pesq">


                    <li>
                        <form action="Home.php" method="post" id="MyFormManu">

                            <input class="input" name="text" id="text" type="text" required placeholder="Pesquisar Curso">

                            <select class="input" name="categoria" id="cat">
                                <option value="0">Categoria de curso</option>
                                <option value="1">Técnico</option>
                                <option value="2">Qualificação</option>
                                <option value="3">Aprendizagem</option>
                                <option value="4">Livre</option>
                            </select>


                            <select class="input" name="status" id="statuetas">
                                <option value="0">Status do curso</option>
                                <option value="1">Aprovado</option>
                                <option value="2">Reprovado</option>
                                <option value="3">Aguardando aprovação</option>
                            </select>


                            <select class="input" name="estado" id="estado">
                                <option value="0">Estado do curso</option>
                                <option value="3">A iniciar</option>
                                <option value="1">Andamento</option>
                                <option value="2">Terminado</option>
                                <option value="4">Cancelado</option>
                            </select>

                        </form>
                    </li>
                </ul>

                <label class="box toggle_pesq" for="toggle_pesq">
                    <img src="img/searcher.png" alt="">
                </label>

            </div>
        </nav>
        <!--FIM NAV AUXILIAR-->
    </header>
                    <?php
                        // if (isset($_SESSION['bug'])) {
                        //     echo $_SESSION['bug'];
                        // }
                    ?>
    <section class="calendar container clearfix">

        <table cellspacing="0" class="table-action">
            <thead>
            <tr>
                <th>Curso</th>
                <th>Qtd. Alunos</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Estado</th>
                <th>Editar</th>
                <th>Aprovar</th>
                <th>Cancelamento</th>
            </tr>
            </thead>
            <tbody id="manutencao_container">
            <?php
            require "Parts/Manutencao_Cursos_Content.php";
            ?>
            </tbody>
        </table>
    </div>
    </section>

    <?php
    require "Parts/Footer.php";
    ?>
</div>

<div id="modal"></div>
<div id="modal_2"></div>


<script src="js/Notificacoes.js" type="text/javascript"></script>
<script src="js/PagManutencao.js" type="text/javascript"></script>
<script src="js/Menu.js" type="text/javascript"></script>

</body>
</html>
