<?php
require "_app/config.php";
$_SESSION['user_acao'] = 3;
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
    <link rel="stylesheet" href="css/Menu.css">
    <link rel="stylesheet" href="css/General.css">
    <link rel="stylesheet" href="css/Footer.css">
    <link rel="stylesheet" href="css/Form.css">

</head>
<body>
<div id="tudo">

    <header>
        <!--NAV MENU-->
        <?= require "Parts/Header_Menu.php"; ?>
        <!--FIM NAV MENU-->
    </header>

    <section class="container section_add_user main_container">
        <?php
        $User = new Select;
        $User->exeSelect("usuarios", "WHERE id_user = :id", array('id' => $_SESSION['user']['id']));
        $U = $User->getResultAssoc();
        $Url = $U['foto'];

        ?>


        <div class="container_form">

            <?php
            if(!empty($_SESSION['error']['Perfil'])){
                echo $_SESSION['error']['Perfil'];
                unset($_SESSION['error']['Perfil']);
            }
            ?>
            
            <div class="title_form clearfix">
                <span>Perfil <?= $_SESSION['user']['nome']; ?></span>
            </div>


            <form action="back/Perfil/Perfil.php" method="post" enctype="multipart/form-data">


                <!--Foto-->
                <div class="material_file clearfix">


                    <div>
                        <div class="img">
                            <canvas id="canvasFoto" width="200px" height="200px">
                            </canvas>
                        </div>
                    </div>


                    <label style="width: auto" for="fileNew" class="label_file">
                        <input class="campoNew" type="file" name="foto" id="fileNew" data-ordem="0">
                        <i class="botao" id="btn_fileNew">ENVIAR FOTO</i>
                    </label>
                    <div style="width: calc(100% - 130px);" class="label_material">
                        <input class="campoNew" id="name_file" type="text" data-ordem="1">
                        <span class="line_bottomNew"></span>
                        <span class="feedbackNew"></span>

                        <span style="display: none" class="line_bottomNew"></span>
                        <span style="display: none" class="feedbackNew"></span>
                    </div>
                </div>

                <!--Nome-->
                <label class="label_material">
                    <input class="campoNew" id="nome" type="text" name="nome" data-ordem="2" required
                           value="<?= $U['nome']; ?>">
                    <span class="placeholder">Nome</span>
                    <span class="line_bottomNew"></span>
                    <span class="feedbackNew"></span>
                </label>


                <!--Email-->
                <label class="label_material">
                    <input class="campoNew mail" type="text" name="email" data-ordem="3" required
                           value="<?= $U['email']; ?>">
                    <span class="placeholder">Email</span>
                    <span class="line_bottomNew"></span>
                    <span class="feedbackNew"></span>
                </label>

                <!--Unidade-->
                <label class="label_material">
                    <input class="campoNew" type="text" name="unidade" data-ordem="4" required
                           value="<?= $U['unidade']; ?>">
                    <span class="placeholder">Unidade</span>
                    <span class="line_bottomNew"></span>
                    <span class="feedbackNew"></span>
                </label>


                <!--Data de Nascimento-->
                <label class="label_material data_input">
                    <input class="campoNew" id="data_n" type="date" name="nascimento" data-ordem="5" required
                           value="<?= $U['data_nasc']; ?>">
                    <span class="placeholder">Data de Nascimento</span>
                    <span class="line_bottomNew"></span>
                    <span class="feedbackNew"></span>
                </label>
                

                <!--Formação-->
                <label class="label_material">
                    <input class="campoNew" id="formacao" type="text" name="formacao" data-ordem="6" required
                           value="<?= $U['formacao']; ?>">
                    <span class="placeholder">Formação</span>
                    <span class="line_bottomNew"></span>
                    <span class="feedbackNew"></span>
                </label>

                <input class="botao" type="submit" id="submitNew" name="add_c" value="ATUALIZAR">
            </form>
        </div>
    </section>

    <?php
    require "Parts/Footer.php";
    ?>
</div>

<div id="modal"></div>
<div id="modal_2"></div>

<script>

    var feedback_Perfil = id('feedback_Submit');

    if(feedback_Perfil){
        window.onbeforeunload = function () {
            feedback_Perfil.remove();
        };
    }

    
    
    var inputFileP = id('fileNew');
    var canvas = id('canvasFoto');


    window.onload = function () {
        canvas.style.display = 'block';

        var ctx = canvas.getContext('2d');

        ctx.clearRect(0, 0, canvas.width, canvas.height);

        var foto = new Image();
        url = "Uploads/Usuarios/<?=$Url;?>";
        foto.src = url;

        foto.onload = function () {

            W = this.width;
            H = this.height;

            if (W >= H) {
                X = (W - H) / 2;
                Y = 0;
                ctx.drawImage(foto, X, Y, H, H, 0, 0, 200, 200);
            } else {
                Y = (H - W) / 2;
                X = 0;
                ctx.drawImage(foto, X, Y, W, W, 0, 0, 200, 200);
            }

        };
    };


    funcionaFormP();


    // Form --

    function funcionaFormP() {

        feedbackNew = className('feedbackNew');
        campoNew = className('campoNew');
        line_bottomNew = className('line_bottomNew');
        btn_fileNew = id('btn_fileNew');
        feedbackNew_check = id('feedbackNew_check');

        submitNew = id('submitNew');

        // Verificar se pode dar submitNew
        sucessP = [];
        sucessP['inputs'] = 0;

        qtdInputsPGenericP = 4;
        qtdInputsP = 7;
        numInputFileP = 0;

        verde = '#2cb92c';
        vermelho = '#ff2b41';


        // Valida campoNews vazios
        for (var i = 0; i < qtdInputsP; i++) {
            campoVazioP(campoNew[i], i);

            if (i == 3) {
                validaEmail(campoNew[i], i);
            }

        }

        AttValidacaoP();

        submitNew.onclick = function (event) {

            // Valida campoNews vazios
            for (var k = 0; k < qtdInputsP; k++) {
                campoVazioP(campoNew[k], k);

                if (k == 3) {
                    validaEmail(campoNew[k], k);
                }

            }

            ValidacaoSubmitP();

            // Valida campoNews vazios
            for (var i = 0; i < qtdInputsP; i++) {
                campoVazioP(campoNew[i], i);
            }


            if (sucessP['inputs'] != qtdInputsPGenericP || sucessP['email'] != 1) {
                event.preventDefault();
                if(feedback_Perfil){
                    feedback_Perfil.remove();
                }
            }

            sucessP['inputs'] = 0;
            sucessP['email'] = 0;

        };

        // Ao mudar input File
        inputFileP.onchange = function (event) {




            // Alterar foto Preview Image
            canvas = id('canvasFoto');

            var ctx = canvas.getContext('2d');

            ctx.clearRect(0, 0, canvas.width, canvas.height);

            var foto = new Image();
            url = URL.createObjectURL(this.files[0]);
            foto.src = url;

            foto.onload = function () {

                W = this.width;
                H = this.height;

                if (W >= H) {
                    X = (W - H) / 2;
                    Y = 0;
                    ctx.drawImage(foto, X, Y, H, H, 0, 0, 200, 200);
                } else {
                    Y = (H - W) / 2;
                    X = 0;
                    ctx.drawImage(foto, X, Y, W, W, 0, 0, 200, 200);
                }

            };
            // fim Alterar foto Preview Image






            var file = event.target.files[0];

            if (file) {

                // Att Input
                name_file.value = event.target.files[0].name;

                // Verificar Mime Type
                mimeTypes = [
                    "image/jpeg",
                    "image/pjpeg",
                    "image/png",
                    "image/gif"
                ];
                if (mimeTypes.indexOf(file.type) == '-1') {

                    showFeedbackNew("Tipo de arquivo não permitido", numInputFileP);
                    btn_fileNew.style.backgroundColor = "#ff2b41";
                    line_bottomNew[numInputFileP].style.backgroundColor = vermelho;

                    sucessP['plano'] = 0;
                } else if (file.size > (1024 * 1024 * 5)) {
                    showFeedbackNew("Arquivo ultrapassar 5MB", numInputFileP);
                    line_bottomNew[numInputFileP].style.backgroundColor = vermelho;
                    btn_fileNew.style.backgroundColor = "#ff2b41";

                    sucessP['plano'] = 0;
                } else if (file.name == null) {
                    sucessP['plano'] = 1;
                } else {
                    showFeedbackNew("", numInputFileP);
                    btn_fileNew.style.backgroundColor = "#00a500";
                    line_bottomNew[numInputFileP].style.backgroundColor = '#00a500';

                    sucessP['plano'] = 1;
                }
            }
        };
    }


    function ValidacaoSubmitP() {
        for (var i = 0; i < qtdInputsP; i++) {
            if (i == 2 || i == 4 || i == 5 || i == 6) {
                if (campoNew[i].value.length == 0 || campoNew[i].value == "" || campoNew[i].value == null || campoNew[i].value == undefined) {
                    sucessP['inputs'] -= 1;
                } else {
                    sucessP['inputs'] += 1;
                }
            }
        }
    }

    function validaEmail(Campo, i) {
        if (Campo.value.match(/^[a-z]*[0-9]*@[a-z]*.com/)) {
            showFeedbackNew("", i);
            line_bottomNew[i].style.backgroundColor = '#00a500';
            line_bottomNew[i].style.width = '100%';
            line_bottomNew[i].style.height = '2px';

            sucessP['email'] = 1;

        } else {
            showFeedbackNew("Formato incorreto", i);
            line_bottomNew[i].style.backgroundColor = vermelho;
            line_bottomNew[i].style.width = '100%';
            line_bottomNew[i].style.height = '2px';

            sucessP['email'] = 0;
        }

    }

    // Att Validação inputs exceto checkbox
    function AttValidacaoP() {
        for (var i = 0; i < qtdInputsP; i++) {

            campoNew[i].onblur = function (event) {
                campoVazioP(event.currentTarget, event.currentTarget.getAttribute('data-ordem'));

                if (this.getAttribute('data-ordem') == 3) {
                    validaEmail(this, this.getAttribute('data-ordem'));
                }
            };
        }
    }

    function campoVazioP(Campo, i) {


        // Validação não funciona para os checboxes de dias
        if (Campo.value.length == 0 || Campo.value == "" || Campo.value == null || Campo.value == undefined) {
            if (i != numInputFileP && i != 1) {

                showFeedbackNew("Campo vazio", i);

                line_bottomNew[i].style.backgroundColor = vermelho;
                line_bottomNew[i].style.width = '100%';
                line_bottomNew[i].style.height = '2px';
            }

        }


        else {
            if (i != numInputFileP && i != 1) {
                showFeedbackNew("", i);
                line_bottomNew[i].style.backgroundColor = '#00a500';
                line_bottomNew[i].style.width = '100%';
                line_bottomNew[i].style.height = '2px';
            }
        }

    }

    function showFeedbackNew(Msg, Num) {
        feedbackNew[Num].innerHTML = Msg;
    }


    function id(id) {
        return document.getElementById(id);
    }


    function className(className) {
        return document.getElementsByClassName(className);
    }


</script>


<script src="js/Notificacoes.js" type="text/javascript"></script>
<script src="js/Menu.js" type="text/javascript"></script>
<script src="js/PagManutencao.js" type="text/javascript"></script>

</body>
</html>