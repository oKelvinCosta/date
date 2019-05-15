<?php
require "_app/config.php";


function feedback_Submit($msg, $class){
    return "<div id='feedback_Submit' class='{$class}'>{$msg}</div>";
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
    <link rel="stylesheet" href="css/Menu.css">
    <link rel="stylesheet" href="css/General.css">
    <link rel="stylesheet" href="css/Footer.css">
    <link rel="stylesheet" href="css/Add_Curso.css">

    <link rel="stylesheet" href="css/Modal.css">

    <link rel="stylesheet" href="css/Form.css">

</head>
<body>
<div id="tudo">
    <header>
        <!--HEADER NAV MENU-->
        <?php
        require "Parts/Header_Menu.php";
        ?>
        <!--FIM HEADER NAV MENU-->
    </header>

    <section class="container add_user main_container">

        <div class="container_form">

            <?php
            if(!empty($_SESSION['error']['Add_Curso'])){
                echo $_SESSION['error']['Add_Curso'];
                unset($_SESSION['error']['Add_Curso']);
            }
            ?>

            <div class="title_form clearfix">
                <span>Adicione um Curso</span>
            </div>


            <form action="back/Add_Curso/Add_Curso.php" method="post" enctype="multipart/form-data">

                <!--CURSO-->
                <label class="label_material">
                    <input class="campo" id="curso" type="text" name="curso" data-ordem="0" required>
                    <span class="placeholder">Curso</span>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>

                <!--TIPO-->
                <label class="label_material">
                    <select class="campo" name="tipo" id="cat" data-ordem="1" required>
                        <option value="">Categoria de curso</option>
                        <option value="6">Aperfeiçoamento</option>
                        <option value="3">Aprendizagem</option>
                        <option value="5">Iniciação</option>
                        <option value="4">Livre</option>
                        <option value="2">Qualificação</option>
                        <option value="1">Técnico</option>
                    </select>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>


                <!--DATA_INICIO-->
                <label class="label_material data_input">
                    <input class="campo" id="data_i" type="date" name="data_i" data-ordem="2" required>
                    <span class="placeholder">Data de Inicio</span>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>


                <!--carga_h-->
                <label class="label_material">
                    <input class="campo" type="text" name="carga_h" data-ordem="3" required>
                    <span class="placeholder">Carga Horária: 200H</span>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>

                <!--PLANO-->
                <div class="material_file clearfix">
                    <label for="file" class="label_file">
                        <input class="campo" type="file" name="plano" id="file" data-ordem="4">
                        <i class="botao" id="btn_file">ENVIAR PLANO DE CURSO</i>
                    </label>
                    <div class="label_material">
                        <input class="campo" id="name_file" type="text" data-ordem="5">
                        <span class="line_bottom"></span>
                        <span class="feedback"></span>

                        <span style="display: none" class="line_bottom"></span>
                        <span style="display: none" class="feedback"></span>
                    </div>
                </div>


                <!--CAPA-->
                <div class="material_file clearfix">

                    <div class="label_material legend">
                        <span class="placeholder">Tamanho mínimo: 1000 x 400</span>
                    </div>

                    <label for="capa" class="label_file">
                        <input class="campo" type="file" name="capa" id="capa" data-ordem="6" required>
                        <i class="botao" id="btn_capa">ENVIAR IMAGEM DE CAPA</i>
                    </label>
                    <div class="label_material">
                        <input class="campo" id="name_capa" type="text" data-ordem="7" required>
                        <span class="line_bottom"></span>
                        <span class="feedback"></span>

                        <span style="display: none" class="line_bottom"></span>
                        <span style="display: none" class="feedback"></span>
                    </div>
                </div>


                <!--DESCRICAO-->
                <label class="label_material">
                    <textarea class="campo" id="desc" name="desc" data-ordem="8" required></textarea>
                    <span class="placeholder">Descrição</span>
                    <span class="line_bottom" style="margin-left: 0;"></span>
                    <span class="feedback"></span>
                </label>


                <input class="botao" type="submit" id="submit" name="add_c" value="ADICIONAR">
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
    var feedBack_Add_Curso = id('feedback_Submit');


    // SET  ----------------------------------
    var feedback = className('feedback');
    var campo = className('campo');
    var line_bottom = className('line_bottom');
    var btn_file = id('btn_file');
    var feedback_check = id('feedback_check');


    var btnCapa = id('btn_capa');
    var textCapa = id('name_capa');
    var inputCapa = id('capa');

    var checkboxes = document.getElementsByName('dias[]');
    var curso = id('curso');
    var cargaH = id('carga_h');
    var desc = id('desc');
    var inputPlano = id('file');
    var name_file = id('name_file');

    var submit = id('submit');
    var error = 0;

    // Verificar se pode dar submit
    var sucess = [];
    sucess['inputs'] = 0;

    // Para se colocar um novo e tiver que validar
    sucess['plano'] = 1;

    var qtdInputsGeneric = 5;
    var qtdInputs = 9;
    var numInputFile = 4;
    var numCapa = 6;

    var verde = '#2cb92c';
    var vermelho = '#ff2b41';


    // FIRE ----------------------------------
    window.onbeforeunload = function () {
        if(feedBack_Add_Curso){

        feedBack_Add_Curso.remove();
        }
    };

    AttValidacao();

    submit.onclick = function (event) {

        ValidacaoSubmit();

        // Valida campos vazios
        for (var i = 0; i < qtdInputs; i++) {
            campoVazio(campo[i], i);
        }

        console.log(sucess);

        if (sucess['inputs'] != qtdInputsGeneric || sucess['plano'] != 1 || sucess['capa'] != 1) {
            event.preventDefault();
            if(feedBack_Add_Curso){

                feedBack_Add_Curso.remove();
            }        }

        sucess['inputs'] = 0;
    };


    // ######## ENVIAR IMAGEM DE CAPA ##############


    // Ao mudar input File Plano de Curso
    inputPlano.onchange = function (event) {
        var file = event.target.files[0];

        if (file) {

            // Att Input
            name_file.value = event.target.files[0].name;

            // Verificar Mime Type
            mimeTypes = [
                "application/msword",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.template",
                "application/vnd.ms-word.document.macroEnabled.12",
                "application/pdf",
                "application/vnd.ms-word.template.macroEnabled.12"
            ];
            if (mimeTypes.indexOf(file.type) == '-1') {

                showFeedback("Tipo de arquivo não permitido", numInputFile);
                btn_file.style.backgroundColor = "#ff2b41";
                line_bottom[numInputFile].style.backgroundColor = vermelho;

                sucess['plano'] = 0;
            } else if (file.size > (1024 * 1024 * 5)) {
                showFeedback("Arquivo ultrapassar 5MB", numInputFile);
                line_bottom[numInputFile].style.backgroundColor = vermelho;
                btn_file.style.backgroundColor = "#ff2b41";

                sucess['plano'] = 0;
            } else {
                showFeedback("", numInputFile);
                btn_file.style.backgroundColor = "#00a500";
                line_bottom[numInputFile].style.backgroundColor = '#00a500';

                sucess['plano'] = 1;
            }
        }
    };

    inputCapa.onchange = function (event) {
        console.log(event.target.files);
        var file = event.target.files[0];

        var jj = new Image();
        jj.src = URL.createObjectURL(file);


        // Att Input
        textCapa.value = file.name;

        // Verificar Mime Type
        mimeTypes = [
            "image/jpeg",
            "image/pjpeg",
            "image/png"
        ];

        if (mimeTypes.indexOf(file.type) == '-1') {

            showFeedback("Tipo de arquivo não permitido", numCapa);
            btnCapa.style.backgroundColor = "#ff2b41";
            line_bottom[numCapa].style.backgroundColor = vermelho;

            sucess['capa'] = 0;
        } else if (file.size > (1024 * 1024 * 5)) {
            showFeedback("Arquivo ultrapassar 5MB", numCapa);
            line_bottom[numCapa].style.backgroundColor = vermelho;
            btnCapa.style.backgroundColor = "#ff2b41";

            sucess['capa'] = 0;
        } else {

            jj.onload = function () {
                var w = this.width;
                var h = this.height;

                if (file) {


                    if (w < 1000 || h < 400) {
                        console.log(h);
                        showFeedback("Dimensões pequenas: " + w + " x " + h, numCapa);
                        line_bottom[numCapa].style.backgroundColor = vermelho;
                        btnCapa.style.backgroundColor = "#ff2b41";

                        sucess['capa'] = 0;
                    } else {
                        showFeedback("", numCapa);
                        btnCapa.style.backgroundColor = "#00a500";
                        line_bottom[numCapa].style.backgroundColor = '#00a500';

                        sucess['capa'] = 1;
                    }
                }

            };
        }
    };


    // FUNCTIONS ----------------------------------
    function ValidacaoSubmit() {
        for (var i = 0; i < qtdInputs; i++) {
            if (i == 0 || i == 1 || i == 2 || i == 3 || i == 8) {
                if (campo[i].value.length == 0 || campo[i].value == "" || campo[i].value == null || campo[i].value == undefined) {
                    sucess['inputs'] -= 1;
                } else {
                    sucess['inputs'] += 1;
                }
            }
        }
    }

    // Att Validação inputs exceto checkbox
    function AttValidacao() {
        for (var i = 0; i < qtdInputs; i++) {

            campo[i].onblur = function (event) {
                campoVazio(event.currentTarget, event.currentTarget.getAttribute('data-ordem'));
            };
        }
    }

    function campoVazio(Campo, i) {


        // Validação não funciona para os checboxes de dias
        if (Campo.value.length == 0 || Campo.value == "" || Campo.value == null || Campo.value == undefined) {

            if (i == numInputFile || i == numInputFile + 1) {

                showFeedback("", i);

                btn_file.style.backgroundColor = "#00a500";

                // Usa o Line Bottom do Botao, não do input text
                line_bottom[numInputFile].style.backgroundColor = '#00a500';

                sucess['plano'] = 1;

            } else if (i == numCapa || i == numCapa + 1) {
                showFeedback("Sem arquivo", i);
                btnCapa.style.backgroundColor = "#ff2b41";
                sucess['capa'] = 0;
            } else {
                showFeedback("Campo vazio", i);
            }
            line_bottom[i].style.backgroundColor = vermelho;
            line_bottom[i].style.width = '100%';
            line_bottom[i].style.height = '2px';

        } else {
            if (i != numInputFile && i != numInputFile + 1 && i != numCapa && i != numCapa + 1) {
                showFeedback("", i);
                line_bottom[i].style.backgroundColor = '#00a500';
                line_bottom[i].style.width = '100%';
                line_bottom[i].style.height = '2px';
            }
        }

    }
    function showFeedback(Msg, Num) {
        feedback[Num].innerHTML = Msg;
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



</body>
</html>