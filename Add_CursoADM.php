<?php
require "_app/config.php";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Date | Calendário de Cursos!</title>
    <meta name="keywords" content="date, senai, cecoteg, cursos, agendamento, calendario">
    <meta name="descNewription" content="date, um site calendário para seus cursoNews!">
    <meta name="author" content="Kelvin Costa">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/Menu.css">
    <link rel="stylesheet" href="css/General.css">
    <link rel="stylesheet" href="css/Footer.css">


    <link rel="stylesheet" href="css/Form.css">

    <style>
        .label_material textarea ~ .line_bottom,
        .label_material textarea ~ .line_bottomNew,
        .label_material textarea ~ .line_bottomAU {
            left: -5px;
        }
    </style>

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

                <!--cursoNew-->
                <label class="label_material">
                    <input class="campoNew" id="cursoNew" type="text" name="curso" data-ordem-new="0" required>
                    <span class="placeholder">Curso</span>
                    <span class="line_bottomNew"></span>
                    <span class="feedbackNew"></span>
                </label>

                <!--TIPO-->
                <label class="label_material">
                    <select class="campoNew" name="categoria" id="cat" data-ordem-new="1" required>
                        <option value="">Categoria de curso</option>
                        <option value="6">Aperfeiçoamento</option>
                        <option value="3">Aprendizagem</option>
                        <option value="5">Iniciação</option>
                        <option value="4">Livre</option>
                        <option value="2">Qualificação</option>
                        <option value="1">Técnico</option>
                    </select>
                    <span class="line_bottomNew"></span>
                    <span class="feedbackNew"></span>
                </label>

                <!--DATA_INICIO-->
                <label class="label_material data_input">
                    <input class="campoNew" id="data_i" type="date" name="data_i" data-ordem-new="2" required>
                    <span class="placeholder">Data de Inicio</span>
                    <span class="line_bottomNew"></span>
                    <span class="feedbackNew"></span>
                </label>

                <!--DATA_FINAL-->
                <label class="label_material data_input">
                    <input class="campoNew" id="data_f" type="date" name="data_f" data-ordem-new="3" required>
                    <span class="placeholder">Data de Término</span>
                    <span class="line_bottomNew"></span>
                    <span class="feedbackNew"></span>
                </label>

                <!--carga_hNew-->
                <label class="label_material">
                    <input class="campoNew" type="text" name="carga_h" data-ordem-new="4" required>
                    <span class="placeholder">Carga Horária: 200H</span>
                    <span class="line_bottomNew"></span>
                    <span class="feedbackNew"></span>
                </label>

                <!--TURNO-->
                <label class="label_material">
                    <select class="campoNew" name="turno" id="turnoNew" data-ordem-new="5" required>
                        <option value="">Turno do Curso</option>
                        <option value="1">Manhã</option>
                        <option value="2">Tarde</option>
                        <option value="3">Noite</option>
                    </select>
                    <span class="line_bottomNew"></span>
                    <span class="feedbackNew"></span>
                </label>

                <!--HORARIO-->
                <label class="label_material">
                    <input class="campoNew" type="text" name="horario" data-ordem-new="6" required>
                    <span class="placeholder">Horário: 00H às 00H</span>
                    <span class="line_bottomNew"></span>
                    <span class="feedbackNew"></span>
                </label>

                <!--PREÇO-->
                <label class="label_material">
                    <input class="campoNew" id="precoNew" type="text" name="preco" data-ordem-new="7" required>
                    <span class="placeholder">Preço: R$: 000,00</span>
                    <span class="line_bottomNew"></span>
                    <span class="feedbackNew"></span>
                </label>



                    <!--QTD MIN ALUNOS-->
                    <label class="label_material">
                        <input class="campoNew" type="number" name="alun_min" data-ordem-new="8" required>
                        <span class="placeholder">Qtd. mínimo alunos</span>
                        <span class="line_bottomNew"></span>
                        <span class="feedbackNew"></span>
                    </label>

                    <!--QTD MAX ALUNOS-->
                    <label class="label_material">
                        <input class="campoNew" type="number" name="alun_max" data-ordem-new="9" required>
                        <span class="placeholder">Qtd. máximo alunos</span>
                        <span class="line_bottomNew"></span>
                        <span class="feedbackNew"></span>
                    </label>



                <!--                Dias Semanais-->
                <div class="label_material conteiner_check ">
                    <div>Dias Semanais</div>
                    <span id="feedback_checkNew"></span>
                    <div class="group_check">
                        <label for="domingoNew">
                            <input type="checkbox" id="domingoNew" name="dias[]" value="0">
                            <i></i>
                            Domingo
                        </label>
                        <label for="segundaNew">
                            <input type="checkbox" id="segundaNew" name="dias[]" value="1">
                            <i></i>
                            Segunda-feira
                        </label>
                        <label for="tercaNew">
                            <input type="checkbox" id="tercaNew" name="dias[]" value="2">
                            <i></i>
                            Terça-feira
                        </label>
                        <label for="quartaNew">
                            <input type="checkbox" id="quartaNew" name="dias[]" value="3">
                            <i></i>
                            Quarta-feira
                        </label>
                        <label for="quintaNew">
                            <input type="checkbox" id="quintaNew" name="dias[]" value="4">
                            <i></i>
                            Quinta-feira
                        </label>
                        <label for="sextaNew">
                            <input type="checkbox" id="sextaNew" name="dias[]" value="5">
                            <i></i>
                            Sexta-feira
                        </label>
                        <label for="sabadoNew">
                            <input type="checkbox" id="sabadoNew" name="dias[]" value="6">
                            <i></i>
                            Sábado
                        </label>
                    </div>
                </div>


                <!--PLANO-->
                <div class="material_fileNew clearfix">
                    <label for="fileNew" class="label_fileNew">
                        <input class="campoNew" type="file" name="plano" id="fileNew" data-ordem-new="10">
                        <i class="botao" id="btn_fileNew">ENVIAR PLANO DE CURSO</i>
                    </label>
                    <div class="label_material">
                        <input class="campoNew" id="name_fileNew" type="text" data-ordem-new="11">
                        <span class="line_bottomNew"></span>
                        <span class="feedbackNew"></span>

                        <span style="display: none" class="line_bottomNew"></span>
                        <span style="display: none" class="feedbackNew"></span>
                    </div>
                </div>


                <!--capaNew-->
                <div class="material_fileNew clearfix">

                    <div class="label_material legend">
                        <span class="placeholder">Tamanho mínimo: 1000 x 400</span>
                    </div>

                    <label for="capaNew" class="label_file">
                        <input class="campoNew" type="file" name="capa" id="capaNew" data-ordem-new="12" required>
                        <i class="botao" id="btn_capaNew">ENVIAR IMAGEM DE CAPA</i>
                    </label>
                    <div class="label_material">
                        <input class="campoNew" id="name_capaNew" type="text" data-ordem-new="13" required>
                        <span class="line_bottomNew"></span>
                        <span class="feedbackNew"></span>

                        <span style="display: none" class="line_bottomNew"></span>
                        <span style="display: none" class="feedbackNew"></span>
                    </div>
                </div>

                <!--descNewRICAO-->
                <label class="label_material">
                    <textarea class="campoNew" id="descNew" name="desc" data-ordem-new="14" required></textarea>
                    <span class="placeholder">Descrição</span>
                    <span class="line_bottomNew"></span>
                    <span class="feedbackNew"></span>
                </label>


                <input class="botao" type="submit" id="submitNew" value="ADICIONAR">
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

    // Feedback que vem da div da session
    var feedBack_Add_Curso = id('feedback_Submit');

    // SET  ----------------------------------
    var feedbackNew = className('feedbackNew');
    var campoNew = className('campoNew');
    var line_bottomNew = className('line_bottomNew');
    var btn_fileNew = id('btn_fileNew');
    var feedback_checkNew = id('feedback_checkNew');

    var checkboxesNew = document.getElementsByName('dias[]');
    var cursoNew = id('cursoNew');
    var cargaHNew = id('carga_hNew');
    var descNew = id('descNew');
    var inputPlanoNew = id('fileNew');
    var name_fileNew = id('name_fileNew');

    var submitNew = id('submitNew');
    var error = 0;

    // Verificar se pode dar submit
    var sucessNew = [];
    sucessNew['inputs'] = 0;


    var qtdInputsNewGenericNew = 9;
    var qtdInputsNew = 15;
    var numInputfileNew = 10;

    var btncapaNew = id('btn_capaNew');
    var textcapaNew = id('name_capaNew');
    var inputcapaNew = id('capaNew');
    var numcapaNew = 12;

    var verde = '#2cb92c';
    var vermelho = '#ff2b41';


    // __3 Situações de Validação
    // Inputs, text, date, selec
        // Inputs checkbox
        // Inputs fileNew com o text








        // FIRE ----------------------------------
        window.onbeforeunload = function () {
            // Seta dnv pois Já vai existir quando for sair da pag
            feedBack_Add_Curso = id('feedback_Submit');
        feedBack_Add_Curso.remove();
    };

    validaCheckboxCalendar();

    AttValidacaoCalendar();

    submitNew.onclick = function (event) {

        ValidacaoSubmitCalendar();

        // Att Validação Checkbox ao dar submit
        var check = 0;
        for (var h = 0; h < checkboxesNew.length; h++) {
            if (checkboxesNew[h].checked) {
                check += 1;
            }
        }
        // Se nenhum for check
        if (check == 0) {
            feedback_checkNew.innerHTML = "Nenhum dia selecionado";
            sucessNew['checkbox'] = 0;
        } else {
            feedback_checkNew.innerHTML = "";
            sucessNew['checkbox'] = 1;
        }

        // Valida campoNews vazios
        for (var i = 0; i < qtdInputsNew; i++) {
            campoVazioCalendar(campoNew[i], i);
        }


        console.log(sucessNew);

        // Erro
        if (sucessNew['inputs'] != qtdInputsNewGenericNew || sucessNew['checkbox'] != 1 || sucessNew['plano'] != 1 || sucessNew['data'] != 1 || sucessNew['capaNew'] != 1) {
            event.preventDefault();

            feedBack_Add_Curso = id('feedback_Submit');
            if(feedBack_Add_Curso){
                feedBack_Add_Curso.remove();
            }
            sucessNew['inputs'] = 0;

        }else{
            //Success
            sucessNew['inputs'] = 0;

        }


    };

    // Ao mudar input fileNew
    inputPlanoNew.onchange = function (event) {
        var fileNew = event.target.files[0];

        if (fileNew) {

            // Att Input
            name_fileNew.value = event.target.files[0].name;

            // Verificar Mime Type
            mimeTypes = [
                "application/msword",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.template",
                "application/vnd.ms-word.document.macroEnabled.12",
                "application/pdf",
                "application/vnd.ms-word.template.macroEnabled.12"
            ];
            if (mimeTypes.indexOf(fileNew.type) == '-1') {

                showFeedbackCalendar("Tipo de arquivo não permitido", numInputfileNew);
                btn_fileNew.style.backgroundColor = "#ff2b41";
                line_bottomNew[numInputfileNew].style.backgroundColor = vermelho;

                sucessNew['plano'] = 0;
            } else if (fileNew.size > (1024 * 1024 * 5)) {
                showFeedbackCalendar("Arquivo ultrapassar 5MB", numInputfileNew);
                line_bottomNew[numInputfileNew].style.backgroundColor = vermelho;
                btn_fileNew.style.backgroundColor = "#ff2b41";

                sucessNew['plano'] = 0;
            } else {
                showFeedbackCalendar("", numInputfileNew);
                btn_fileNew.style.backgroundColor = "#00a500";
                line_bottomNew[numInputfileNew].style.backgroundColor = '#00a500';

                sucessNew['plano'] = 1;
            }
        }
    };

    inputcapaNew.onchange = function (event) {
        var fileNew = event.target.files[0];

        var jj = new Image();
        jj.src = URL.createObjectURL(fileNew);


        // Att Input
        textcapaNew.value = fileNew.name;

        // Verificar Mime Type
        mimeTypes = [
            "image/jpeg",
            "image/pjpeg",
            "image/png"
        ];

        if (mimeTypes.indexOf(fileNew.type) == '-1') {

            showFeedbackCalendar("Tipo de arquivo não permitido", numcapaNew);
            btncapaNew.style.backgroundColor = "#ff2b41";
            line_bottomNew[numcapaNew].style.backgroundColor = vermelho;

            sucessNew['capaNew'] = 0;
        } else if (fileNew.size > (1024 * 1024 * 5)) {
            showFeedbackCalendar("Arquivo ultrapassar 5MB", numcapaNew);
            line_bottomNew[numcapaNew].style.backgroundColor = vermelho;
            btncapaNew.style.backgroundColor = "#ff2b41";

            sucessNew['capaNew'] = 0;
        } else {

            jj.onload = function () {
                var w = this.width;
                var h = this.height;

                if (fileNew) {


                    if (w < 1000 || h < 400) {
                        showFeedbackCalendar("Dimensões pequenas: " + w + " x " + h, numcapaNew);
                        line_bottomNew[numcapaNew].style.backgroundColor = vermelho;
                        btncapaNew.style.backgroundColor = "#ff2b41";

                        sucessNew['capaNew'] = 0;
                    } else {
                        showFeedbackCalendar("", numcapaNew);
                        btncapaNew.style.backgroundColor = "#00a500";
                        line_bottomNew[numcapaNew].style.backgroundColor = '#00a500';

                        sucessNew['capaNew'] = 1;
                    }
                }

            };
        }
    };













    // FUNCTIONS ----------------------------------





    function ValidacaoSubmitCalendar() {
        for (var i = 0; i < qtdInputsNew; i++) {
            if( i == 0 || i == 1 || i == 4 || i == 5 || i == 6 || i == 7 || i == 8 || i == 9 || i == 14 ){
                if( campoNew[i].value.length == 0 || campoNew[i].value == "" || campoNew[i].value == null || campoNew[i].value == undefined) {
                    sucessNew['inputs'] -= 1;
                }else{
                    sucessNew['inputs'] += 1;
                }
            }
        }
    }


    // Att Validação inputs exceto checkbox
    function AttValidacaoCalendar() {
        for (var i = 0; i < qtdInputsNew; i++) {
            campoNew[i].onblur = function () {
                campoVazioCalendar(this, this.getAttribute('data-ordem-new'));
            };
        }
    }

    // Valida Att checkbox
    function validaCheckboxCalendar() {
        for (var i = 0; i < checkboxesNew.length; i++) {
            checkboxesNew[i].onchange = function () {
                var check = 0;
                for (var i = 0; i < checkboxesNew.length; i++) {
                    if (checkboxesNew[i].checked) {
                        check += 1;
                    }
                }

                // Se nenhum for check
                if (check == 0) {
                    feedback_checkNew.innerHTML = "Nenhum dia selecionado";
                    sucessNew['checkbox'] = 0;
                } else {
                    feedback_checkNew.innerHTML = "";
                    sucessNew['checkbox'] = 1;
                }
            };
        }
    }


    function campoVazioCalendar(campoF, i) {
        console.log(campoF);
        // Validação não funciona para os checboxes de dias
        if (campoF.value.length == 0 || campoF.value == "" || campoF.value == null || campoF.value == undefined) {
             if(i == numInputfileNew || i == numInputfileNew + 1) {
                 showFeedbackCalendar("Sem arquivo", numInputfileNew);
                 btn_fileNew.style.backgroundColor = "#ff2b41";
                 line_bottomNew[numInputfileNew].style.backgroundColor = '#ff2b41';
                 sucessNew['plano'] = 0;

             } else if (i == numcapaNew || i == numcapaNew + 1) {
                 showFeedbackCalendar("Sem arquivo", i);
                 btncapaNew.style.backgroundColor = "#ff2b41";
                 sucessNew['capaNew'] = 0;
             }else {
                showFeedbackCalendar("Campo vazio", i);
            }
            line_bottomNew[i].style.backgroundColor = vermelho;
            line_bottomNew[i].style.width = '100%';
            line_bottomNew[i].style.height = '2px';

        } else if (i == 3 || i== 2) {


            // Compara Datas

            var iniNew = campoNew[2].value;
            var finiNew = campoNew[3].value;

            if(iniNew && finiNew){
                if(iniNew > finiNew){
                    showFeedbackCalendar("Data incorreta", 2);
                    line_bottomNew[2].style.backgroundColor = vermelho;
                    line_bottomNew[2].style.width = '100%';
                    line_bottomNew[2].style.height = '2px';

                    showFeedbackCalendar("Data incorreta", 3);
                    line_bottomNew[3].style.backgroundColor = vermelho;
                    line_bottomNew[3].style.width = '100%';
                    line_bottomNew[3].style.height = '2px';

                    sucessNew['data'] = 0;
                }else{
                    showFeedbackCalendar("", 2);
                    line_bottomNew[2].style.backgroundColor = '#00a500';
                    line_bottomNew[2].style.width = '100%';
                    line_bottomNew[2].style.height = '2px';

                    showFeedbackCalendar("", 3);
                    line_bottomNew[3].style.backgroundColor = '#00a500';
                    line_bottomNew[3].style.width = '100%';
                    line_bottomNew[3].style.height = '2px';

                    sucessNew['data'] = 1;
                }
            }else if(iniNew){
                showFeedbackCalendar("", 2);
                line_bottomNew[2].style.backgroundColor = '#00a500';
                line_bottomNew[2].style.width = '100%';
                line_bottomNew[2].style.height = '2px';
            }else if(finiNew){
                showFeedbackCalendar("", 3);
                line_bottomNew[3].style.backgroundColor = '#00a500';
                line_bottomNew[3].style.width = '100%';
                line_bottomNew[3].style.height = '2px';
            }


        } else {
            if (i != numInputfileNew && i != numcapaNew) {
                showFeedbackCalendar("", i);
                line_bottomNew[i].style.backgroundColor = '#00a500';
                line_bottomNew[i].style.width = '100%';
                line_bottomNew[i].style.height = '2px';
            }
        }

    }

    function showFeedbackCalendar(Msg, Num) {
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

