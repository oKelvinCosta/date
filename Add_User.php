<?php
require "_app/config.php";





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
    <header id="add_user">
        <!--NAV MENU-->
        <?= require "Parts/Header_Menu.php"; ?>
        <!--FIM NAV MENU-->
    </header>

    <section class="container add_user main_container">
        <div class="container_form">
            
            <?php
            if(!empty($_SESSION['error']['Add_User'])){
                echo $_SESSION['error']['Add_User'];
                unset($_SESSION['error']['Add_User']);
            }
            ?>
            
            <div class="title_form clearfix">
                <span>Adicione um Usuário</span>
            </div>


            <form action="back/Add_User.php" method="post" enctype="multipart/form-data">

                <!--Nome-->
                <label class="label_material">
                    <input class="campoAU" id="nomeAU" type="text" name="nome" data-ordem="0" required>
                    <span class="placeholder">Nome</span>
                    <span class="line_bottomAU"></span>
                    <span class="feedbackAU"></span>
                </label>


                <!--Email-->
                <label class="label_material">
                    <input class="campoAU mail" type="text" name="email" data-ordem="1" required>
                    <span class="placeholder">Email</span>
                    <span class="line_bottomAU"></span>
                    <span class="feedbackAU"></span>
                </label>

                <!--Unidade-->
                <label class="label_material">
                    <input class="campoAU" type="text" name="unidade" data-ordem="2" required>
                    <span class="placeholder">Unidade</span>
                    <span class="line_bottomAU"></span>
                    <span class="feedbackAU"></span>
                </label>

                <!--Categoria-->
                <label class="label_material">
                    <select class="campoAU" name="permicao" id="permicaoAU" data-ordem="3" required>
                        <option value="">Selecione a permissão do usuário</option>
                        <option value="1">Administrador</option>
                        <option value="2">Professor</option>
                        <option value="3">Secretaria</option>
                    </select>
                    <span class="line_bottomAU"></span>
                    <span class="feedbackAU"></span>
                </label>

                <!--                    Data de Nascimento-->
                <label class="label_material data_input">
                    <input class="campoAU" id="data_nAU" type="date" name="nascimento" data-ordem="4" required>
                    <span class="placeholder">Data de Nascimento</span>
                    <span class="line_bottomAU"></span>
                    <span class="feedbackAU"></span>
                </label>

                <!--Senha-->
                <label class="label_material">
                    <input class="campoAU" id="senhaAU" type="password" name="senha" data-ordem="5" required>
                    <span class="placeholder">Senha</span>
                    <span class="line_bottomAU"></span>
                    <span class="feedbackAU"></span>
                </label>

                <!--Confirmar Senha-->
                <label class="label_material">
                    <input class="campoAU" id="csenhaAU" type="password" name="csenha" data-ordem="6" required>
                    <span class="placeholder">Confirmar Senha</span>
                    <span class="line_bottomAU"></span>
                    <span class="feedbackAU"></span>
                </label>

                <!--Formação-->
                <label class="label_material">
                    <input class="campoAU" id="formacaoAU" type="text" name="formacao" data-ordem="7" required>
                    <span class="placeholder">Formação</span>
                    <span class="line_bottomAU"></span>
                    <span class="feedbackAU"></span>
                </label>

                <!--Foto-->
                <div class="material_fileAU clearfix">
                    <label style="width: auto" for="fileAU" class="label_fileAU">
                        <input class="campoAU" type="file" name="foto" id="fileAU" data-ordem="8" required>
                        <i class="botao" id="btn_fileAU">ENVIAR FOTO</i>
                    </label>
                    <div style="width: calc(100% - 130px);" class="label_material">
                        <input class="campoAU" id="name_fileAU" type="text" data-ordem="9" required>
                        <span class="line_bottomAU"></span>
                        <span class="feedbackAU"></span>

                        <span style="display: none" class="line_bottomAU"></span>
                        <span style="display: none" class="feedbackAU"></span>
                    </div>
                </div>

                <input style="margin-left: -2px;" class="botao" type="submit" id="submitAU" name="add_c" value="ADICIONAR">
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


    // SET  ----------------------------------

    var feedBack_Add_User = id('feedback_Submit');


    var feedbackAU = className('feedbackAU');
    var campoAU = className('campoAU');
    var line_bottomAU = className('line_bottomAU');
    var btn_fileAU = id('btn_fileAU');
    var feedback_checkAU = id('feedback_checkAU');

    var checkboxesAU = document.getElementsByName('dias[]');
    var cursoAU = id('cursoAU');
    var cargaH = id('carga_hAU');
    var descAU = id('descAU');
    var inputPlanoAU = id('fileAU');
    var name_fileAU = id('name_fileAU');

    var submitAU = id('submitAU');
    var error = 0;

    // Verificar se pode dar submit
    var sucessAU = [];
    sucessAU['inputs'] = 0;

    var qtdInputsGenericAU = 7;
    var qtdInputsAU = 10;
    var numInputFileAU = 8;

    var verde = '#2cb92c';
    var vermelho = '#ff2b41';


    // FIRE ----------------------------------

    window.onbeforeunload = function () {
        feedback_Add_User.remove();
    };

    AttValidacaoAU();

    submitAU.onclick = function (event) {

        ValidacaoSubmitAU();

        // Valida campos vazios
        for (var i = 0; i < qtdInputsAU; i++) {
            campoVazioAU(campoAU[i], i);
        }

        console.log(sucessAU);

        if (sucessAU['inputs'] != qtdInputsGenericAU || sucessAU['plano'] != 1 || sucessAU['email'] != 1) {
            event.preventDefault();
            feedback_Add_User.remove();
        }
        sucessAU['inputs'] = 0;

    };

    // Ao mudar input File
    inputPlanoAU.onchange = function (event) {
        var fileAU = event.target.files[0];

        if (fileAU) {

            // Att Input
            name_fileAU.value = event.target.files[0].name;

            // Verificar Mime Type
            mimeTypes = [
                "image/jpeg",
                "image/pjpeg",
                "image/png",
                "image/gif"
            ];
            if (mimeTypes.indexOf(fileAU.type) == '-1') {

                showFeedbackAU("Tipo de arquivo não permitido", numInputFileAU);
                btn_fileAU.style.backgroundColor = "#ff2b41";
                line_bottomAU[numInputFileAU].style.backgroundColor = vermelho;

                sucessAU['plano'] = 0;
            } else if (fileAU.size > (1024 * 1024 * 5)) {
                showFeedbackAU("Arquivo ultrapassar 5MB", numInputFileAU);
                line_bottomAU[numInputFileAU].style.backgroundColor = vermelho;
                btn_fileAU.style.backgroundColor = "#ff2b41";

                sucessAU['plano'] = 0;
            } else {
                showFeedbackAU("", numInputFileAU);
                btn_fileAU.style.backgroundColor = "#2cb92c";
                line_bottomAU[numInputFileAU].style.backgroundColor = verde;

                sucessAU['plano'] = 1;
            }
        }
    };


    // FUNCTIONS ----------------------------------


    function ValidacaoSubmitAU() {
        for (var i = 0; i < qtdInputsAU; i++) {
            if (i == 0 || i == 2 || i == 3 || i == 4 || i == 5 || i == 6 || i == 7 ) {
                if (campoAU[i].value.length == 0 || campoAU[i].value == "" || campoAU[i].value == null || campoAU[i].value == undefined) {
                    sucessAU['inputs'] -= 1;
                } else {
                    sucessAU['inputs'] += 1;
                }
            }
        }
    }


    function validaEmailAU(Campo, i) {
            if(Campo.value.match(/^[a-z]*[0-9]*@[a-z]*.com/)){
                showFeedbackAU("", i);
                line_bottomAU[i].style.backgroundColor = verde;
                line_bottomAU[i].style.width = '100%';
                line_bottomAU[i].style.height = '2px';

                sucessAU['email'] = 1;

            }else{
                showFeedbackAU("Formato incorreto", i);
                line_bottomAU[i].style.backgroundColor = vermelho;
                line_bottomAU[i].style.width = '100%';
                line_bottomAU[i].style.height = '2px';

                sucessAU['email'] = 0;
            }

    }

    // Att Validação inputs exceto checkbox
    function AttValidacaoAU() {
        for (var i = 0; i < qtdInputsAU; i++) {

            campoAU[i].onblur = function (event) {
                campoVazioAU(event.currentTarget, event.currentTarget.getAttribute('data-ordem'));

                if( this.getAttribute('data-ordem') == 1 ){
                    validaEmailAU(this, this.getAttribute('data-ordem'));
                }
            };
        }
    }

    function campoVazioAU(Campo, i) {


        // Validação não funciona para os checboxes de dias
        if (Campo.value.length == 0 || Campo.value == "" || Campo.value == null || Campo.value == undefined) {
            if (i == numInputFileAU) {
                showFeedbackAU("Sem arquivo", i);
                btn_fileAU.style.backgroundColor = "#ff2b41";
                sucessAU['plano'] = 0;
            } else {
                showFeedbackAU("Campo vazio", i);
            }
            line_bottomAU[i].style.backgroundColor = vermelho;
            line_bottomAU[i].style.width = '100%';
            line_bottomAU[i].style.height = '2px';

        } else if ( Campo == campoAU[5] || Campo == campoAU[6] ) {
            if ((campoAU[5].value != "" && campoAU[6].value != "")) {
                if (campoAU[5].value == campoAU[6].value) {
                    showFeedbackAU("", 6);
                    line_bottomAU[6].style.backgroundColor = verde;
                    line_bottomAU[6].style.width = '100%';
                    line_bottomAU[6].style.height = '2px';

                    showFeedbackAU("", 5);
                    line_bottomAU[5].style.backgroundColor = verde;
                    line_bottomAU[5].style.width = '100%';
                    line_bottomAU[5].style.height = '2px';

                } else {
                    showFeedbackAU("Confirme a senha corretamente", 6);
                    line_bottomAU[6].style.backgroundColor = vermelho;
                    line_bottomAU[6].style.width = '100%';
                    line_bottomAU[6].style.height = '2px';
                }
            }else if(campoAU[5].value != ""){
                showFeedbackAU("", 5);
                line_bottomAU[5].style.backgroundColor = verde;
                line_bottomAU[5].style.width = '100%';
                line_bottomAU[5].style.height = '2px';

            }else if(campoAU[6].value != ""){
                showFeedbackAU("", 6);
                line_bottomAU[6].style.backgroundColor = verde;
                line_bottomAU[6].style.width = '100%';
                line_bottomAU[6].style.height = '2px';
            }

        } else {
            if (i != numInputFileAU && i != 1) {
                    showFeedbackAU("", i);
                    line_bottomAU[i].style.backgroundColor = verde;
                    line_bottomAU[i].style.width = '100%';
                    line_bottomAU[i].style.height = '2px';
            }
        }

    }
    function showFeedbackAU(Msg, Num) {
        feedbackAU[Num].innerHTML = Msg;
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