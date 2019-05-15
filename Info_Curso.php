<?php

function showDias($Id_Dias)
{
    for ($i = 0; $i < 7; $i++) {
        $k = (string) $i;
        if (strchr($Id_Dias, $k)) {
            switch ($k) {
                case '0':
                    echo "<div>Domingo</div>";
                    break;
                case '1':
                    echo "<div>Segunda-Feira</div>";
                    break;
                case '2':
                    echo "<div>Terça-Feira</div>";
                    break;
                case '3':
                    echo "<div>Quarta-Feira</div>";
                    break;
                case '4':
                    echo "<div>Quinta-Feira</div>";
                    break;
                case '5':
                    echo "<div>Sexta-Feira</div>";
                    break;
                case '6':
                    echo "<div>Sábado</div>";
                    break;
            }
        }
    }
}


function UrlAtual()
{
    $dominio= $_SERVER['HTTP_HOST'];
    $url = "http://" . $dominio. $_SERVER['REQUEST_URI'];
    return $url;
}



require "_app/config1.php";

$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);


$Curso = new Select;
$Curso->exeSelect("cursos", "WHERE id_curso = :id", array('id' => $get['idCurso']));


$C = $Curso->getResultAssoc();

?>


<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="<?= $C['descricao']; ?>">
    <meta name="author" content="Kelvin Costa">
    <meta name="keywords" content="curso, senai, cecoteg, kelvin">

    <meta property="og:url"           content="<?= UrlAtual();?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?= $C['nome']; ?>" />
    <meta property="og:image:width"         content="400" />
    <meta property="og:image:height"         content="300" />
    <meta property="fb:app_id"         content="112736509336305" />
    <meta property="og:description"   content="<?= $C['descricao']; ?>" />
    <meta property="og:image"         content="http://www.datececoteg.com/datececoteg.com/senai/Uploads/Capas/<?= $C['capa']; ?>" />



    <title>Curso <?= $C['nome']; ?></title>

    <link rel="stylesheet" href="css/LayoutDinamic.css">
    <link rel="stylesheet" href="css/Form.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="icon" href="img/Favicon/Senai.ico" sizes="16x16">


</head>
<body>

<div id="margem">

    <div id="tudo">

        <section id="screen">


            <header class="container"><h1><?= $C['nome']; ?></h1></header>
            <div style="background-image: url('Uploads/Capas/<?= $C['capa']; ?>')" class="fullWidth"
                 id="great_image">
            </div>
            <div id="curso_info">
                <div id="main_info" class="clearfix">
                    <div class="left">
                        <h2 class=""><?= $C['horario']; ?></h2>

                            <?php
                            // ESTADO


                            if ($C['turma_cancelada'] == 1) {
                                ?>
                            <h2  class='estado red'>
                                Cancelado
                            </h2>
                                <?php
                            } elseif ($C['data_final'] >= date("Y-m-d") and $C['data_inicio'] <= date("Y-m-d")) {
                                ?>
                                <h2  class='estado blue'>
                                    Andamento
                                </h2>
                                <?php
                            } elseif ($C['data_inicio'] > date("Y-m-d") and $C['status'] != 3) {
                                ?>
                                <h2  class='estado green'>
                                    A Iniciar
                                </h2>
                                <?php
                            }
                            ?>


                        <h2 class="h"><?= $C['carga_h']; ?></h2>
                    </div>

                    <div class="right">
                        <!--Colocar  url dessa pág para compartilhar-->
                        <div class="facebook_share">
                            <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?= UrlAtual();?>&layout=button&size=small&mobile_iframe=true&width=97&height=20&appId"
                                    width="97" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                        </div>

                        <div class="toEmail">
                            <a href="mailto:?subject=Curso%20<?=$C['nome'];?>%20no%20SENAI&amp;body=Olá!%20O%20SENAI%20está%20com%20curso%20novo:%20<?=$C['nome'];?>%20conheça%20mais%20sobre%20esse%20e%20mais%20cursos%20neste%20link:%20http://www.google.com&amp;">Enviar por Email</a>
                        </div>
                    </div>


                </div>
                <div class="clearfix info_3">
                    <div id="descricao">
                        <p>
                            <?= $C['descricao']; ?>
                        </p>
                    </div>
                    <div id="side_info">
                        <ul class="clearfix">
                            <li>
                                <h3 class="colorRed">DATA DE INICIO</h3>
                                <div><?= date("d-m-Y", strtotime($C['data_inicio'])); ?></div>
                            </li>
                            <li>
                                <h3 class="colorRed">PREÇO</h3>
                                <div><?= $C['preco']; ?></div>
                            </li>
                            <li>
                                <h3 class="colorRed">DATA DE TÉRMINO</h3>
                                <div><?= date("d-m-Y", strtotime($C['data_final'])); ?></div>
                            </li>
                            <li class="diasSemanais">
                                <h3 class="colorRed">DIAS SEMANAIS</h3>

                                    <?php
                                    showDias($C['id_dias']);
                                    ?>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>





        <?php
        $Slider = new Select;
        $Slider->exeSelect("cursos", "WHERE data_inicio > :data AND status = :status AND id_curso != :id", array('data' => date("Y-m-d"), 'status' => 1, 'id' =>$get['idCurso']));
        $i = 1;
        $o = 0;
        $limit = 3;
        $rows = $Slider->getRows();

        if ($rows <= 3) {
            $desactiveL = "desactiveL";
            $desactiveR = "desactiveR";
        } else {
            $desactiveL = "";
            $desactiveR = "";
        }

        $off = '';

        if ($rows >= 3) {
            $padding_bottom = "pd_bD";
        } elseif ($rows == 2) {
            $padding_bottom = "pd_b2";
        } elseif ($rows == 1) {
            $padding_bottom = "pd_b1";
        } else {
            $off = "offpd";
        }


        ?>

        <section class="container <?=$off;?>" id="cursos">
            <div class="cabecalho clearfix">
                <h1 class="colorRed">MAIS CURSOS</h1>
                <div>
                    <a href="javascript:void(0)" id="prevC" class="<?= $desactiveL; ?>"></a>
                    <a href="javascript:void(0)" id="nextC" class="<?= $desactiveR; ?>"></a>
                </div>

                <div id="slideMobile" class="offDesk">
                    <a href="javascript:void(0)" id="prevM" class="<?= $desactiveL; ?>"></a>
                    <a href="javascript:void(0)" id="nextM" class="<?= $desactiveR; ?>"></a>
                </div>
            </div>


            <ul id="Content" class="clearfix <?= @$padding_bottom;?>">

                <?php
                while (ceil($rows / 3) >= $i) {
                    ?>
                    <li>
                        <?php

                        $off = ($i * $limit) - $limit;
                    $Block = new Select;
                    $Block->exeSelect("cursos", "WHERE data_inicio > :data AND status = :status AND id_curso != :id LIMIT :limit OFFSET :offset", array('data' => date("Y-m-d"), 'limit' => $limit, 'offset' => $off, 'status' => 1, 'id' =>$get['idCurso']));

                    while ($B = $Block->getResultAssoc()) {
                        ?>
                            <a href="Info_Curso.php?idCurso= <?= $B['id_curso']; ?>">
                                <div class="img">
                                    <img src="Uploads/Capas/<?= $B['capa']; ?>" alt="">
                                </div>
                                <div class="title">
                                    <?= $B['nome']; ?>
                                </div>
                            </a>
                            <?php
                    } ?>
                    </li>
                    <?php
                    $i++;
                }
                ?>

            </ul>
        </section>

        <section id="newsletter">

            <?php
            if (!empty($_SESSION['error']['newsletter'])) {
                echo $_SESSION['error']['newsletter'];
                unset($_SESSION['error']['newsletter']);
            }
            ?>

            <h1 class="colorRed">NEWSLETTER</h1>
            <p class="att">Fique atualizado!</p>
            <p>Insira o seu email para receber as notícias sobre novos cursos</p>
            <form action="back/Newsletter_Cadastro.php" method="post" id="FormNews">
                <!--Email-->
                <label class="label_material">
                    <input class="campo mail" type="text" name="email" data-ordem="0" required>
                    <span class="placeholder">Email</span>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>

                <label for="send">
                    <img src="img/icons/sent-mail.svg" alt="">
                    <input id="send" type="submit">
                </label>
            </form>
        </section>

        <footer>
            <div class="main clearfix">
                <ul>
                    <li>
                        <h1>ENDEREÇO SENAI CECOTEG</h1>
                        <p>Rua Santo Agostinho, 1717, Bairro Horto</p>
                    </li>
                    <li>
                        <h1>TELEFONE</h1>
                        <p>(31) 3482-5635</p>
                    </li>
                    <li>
                        <h1>EMAIL</h1>
                        <p>senaicecoteg@fiemg.com.br</p>
                    </li>
                    <li>
                        <h1>SOCIAL</h1>
                        <a target="_blank" href="https://www.facebook.com/CECOTEG/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a target="_blank" href="https://www.instagram.com/cecoteg/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
            <div class="sub">
                <ul>
                    <li><span>Feito por</span> <a style="color: #c1c1c1; font-size: 10px; letter-spacing: 0.5px;" href="https://www.kelvincosta.com">KELVIN COSTA</a><span> - okelvincosta@gmail.com</span></li>
                    <li>© 2016 SENAI CECOTEG - Todos os direitos reservados.</li>
                    <li>Termos de Uso.</li>
                    <li>Política de Privacidade.</li>
                </ul>
            </div>
        </footer>
    </div>
</div>



<script>

    var cursosSection = query("#cursos");
    var Content = query("#Content");

    // Bloco
    var primeiro = query("#Content li:first-child");
    var ultimo = query("#Content li:last-child");

    // Bloco atual
    var atual = primeiro;
    atual.classList.add("active");


    console.log(Content.children.length);



    if(cursosSection && Content.children.length > 1){
        SlideCursos();
    }

    function SlideCursos() {

        // Botoes
        var next = query("#nextC");
        var prev = query("#prevC");
        var nextM = query("#nextM");
        var prevM = query("#prevM");
        // Container
        var slider = query("#Content");



        // Timer
        var time = setInterval('passaSlider()', 5000);

        next.onclick = function () {
            clearInterval(time);
            passaSlider();
            time = setInterval('passaSlider()', 5000);
        };

        prev.onclick = function () {
            clearInterval(time);
            passaSliderPrev();
            time = setInterval('passaSlider()', 5000);
        };

        nextM.onclick = function () {
            clearInterval(time);
            passaSlider();
            time = setInterval('passaSlider()', 5000);
        };

        prevM.onclick = function () {
            clearInterval(time);
            passaSliderPrev();
            time = setInterval('passaSlider()', 5000);
        };
    }

    function passaSlider() {


        if (atual.nextElementSibling) {
            atual.classList.remove('active');

            atual = atual.nextElementSibling;
            atual.classList.add('active');
        } else {
            atual.classList.remove('active');

            atual = primeiro;
            atual.classList.add('active');
        }
    }

    function passaSliderPrev() {
        if (atual.previousElementSibling) {
            atual.classList.remove('active');

            atual = atual.previousElementSibling;
            atual.classList.add('active');
        } else {
            atual.classList.remove('active');

            atual = ultimo;
            atual.classList.add('active');
        }
    }

    function query(query) {
        return document.querySelector(query);
    }
</script>


</body>
</html>
