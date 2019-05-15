<?php
require "_app/config.php";

@$_SESSION['user_acao'] = 1;

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
    <link rel="stylesheet" href="css/Users.css">
    <link rel="stylesheet" href="css/Form.css">

</head>
<body id="body">
<div id="tudo">

    <div class="space_top_users">

    <header>
        <!--NAV MENU-->
        <?php require "Parts/Header_Menu.php" ?>
        <!--FIM NAV MENU-->


        <!--NAV AUXILIAR-->

        <nav class="orientador">
            <div class="container clearfix">
                <ul class="title">
                    <li>

                        <span>Usuários</span>
                    </li>
                </ul>


                <ul class="pesq">

                    <li>
                        <form action="#" method="post" id="PesquisaU">

                            <input type="text" name="text" id="textU" placeholder="Pesquisar Usuário">

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



        <section id="section_users" class="container clearfix section_user">


            <?php
            $Select = new Select;
            $Select->exeSelect("usuarios", "WHERE desligado != :des", array('des' => 1));
            require "Parts/Usuarios.php";
            ?>


        </section>

        <?php
        require "Parts/Footer.php";
        ?>
    </div>
</div>
</div>

<div id="modal"></div>
<div id="modal_2"></div>


<script>

    // SET ---------------------------------------------------------------------------------

    // Info User
    var modal = id('modal');
    var info_user = className("info_user");

    // Editar Direto
    var user_editar = className('user_editar');
    var user_excluir = className('user_excluir');


    // FIRE ---------------------------------------------------------------------------------

    PesquisaU();

    excluir_User();

    open_Modal_EditarU();

    open_Modal_Info_User();

    // QUANDOF AZ UPDATE A PesquisaU SE INVALIDA

    // FUNCTIONS ---------------------------------------------------------------------------------

    // PesquisaU
    function PesquisaU() {
        // PesquisaU
        var textU = id('textU');
        textU.onkeyup = function () {
            loadDoc_PesquisaU_User("back/Users/Pesquisa_User.php");
        };
    }

    function loadDoc_PesquisaU_User(Url) {

        var formPesquisaU = id('PesquisaU');
        var formData = new FormData(formPesquisaU);

        var jax = new XMLHttpRequest;
        jax.onreadystatechange = function () {
            if (jax.readyState == 4 && jax.status == 200) {

                var section_users = id('section_users');
                section_users.innerHTML = jax.responseText;

                fecha_ModalU();

                excluir_User();

                open_Modal_EditarU();

                open_Modal_Info_User();
            }
        };
        jax.open("POST", Url, true);
        jax.send(formData);
    }


    // Excluir User
    function excluir_User(event) {
        textU = id('textU');
        user_excluir = className('user_excluir');

        for (var i = 0; user_excluir[i]; i++) {
            user_excluir[i].onclick = function (event) {
                event.stopPropagation();
                loadDoc_Excluir_User("back/Users/Excluir_User.php?idUser=" + this.getAttribute('data-user_id-type') + "&text=" + textU.value);
            };
        }

    }

    function loadDoc_Excluir_User(Url) {
        var jax = new XMLHttpRequest;
        jax.onreadystatechange = function () {
            if (jax.readyState == 4 && jax.status == 200) {

                var section_users = id('section_users');
                section_users.innerHTML = jax.responseText;


                // Remove o conteúdo da modal
                modal_off = id('modal_off');
                if (modal_off) {
                    modal_off.remove();
                }
                modal.style.cssText = "opacity:0; pointer-events: none";

                excluir_User();

                open_Modal_EditarU();

                open_Modal_Info_User();
            }
        };
        jax.open("GET", Url, true);
        jax.send();
    }




    // Modal Editar
    function open_Modal_EditarU() {
        for (var i = 0; user_editar[i]; i++) {
            user_editar[i].onclick = function (event) {
                event.stopPropagation();
                modal.style.cssText = "opacity:1; pointer-events:auto";
                document.getElementsByTagName('body')[0].style.cssText = "overflow: hidden;";
                loadDoc_Modal_Editar_User("back/Users/Modal_Edit_User.php?idUser=" + this.getAttribute("data-user_id-type"));
            };
        }
    }

    function loadDoc_Modal_Editar_User(Url) {
        var jax = new XMLHttpRequest;
        jax.onreadystatechange = function () {
            if (jax.readyState == 4 && jax.status == 200) {

                modal.innerHTML = jax.responseText;
                fecha_ModalU();


                funcionaFormU();

            }
        };
        jax.open("GET", Url, true);
        jax.send();
    }


    // Modal Info User
    function open_Modal_Info_User() {
        for (var i = 0; info_user[i]; i++) {
            info_user[i].onclick = function () {
                modal.style.cssText = "opacity:1; pointer-events:auto";
                document.getElementsByTagName('body')[0].style.cssText = "overflow: hidden;";
                loadDoc_Modal_Info_User("back/Users/Modal_Edit_User.php?idUser=" + this.getAttribute("data-user_id-type"));
            };
        }
    }

    function loadDoc_Modal_Info_User(Url) {
        var jax = new XMLHttpRequest;
        jax.onreadystatechange = function () {
            if (jax.readyState == 4 && jax.status == 200) {

                modal.innerHTML = jax.responseText;

                user_editar = className('user_editar');
                open_Modal_EditarU();

                excluir_User();

                fecha_ModalU();

                funcionaFormU();


            }
        };
        jax.open("GET", Url, true);
        jax.send();
    }


    // Fechar modal
    function fecha_ModalU() {
        var modal_off = id('modal_off');
        window.onclick = function (event) {
            if (event.target == modal_off) {
                // Remove o conteúdo da modal
                modal_off.remove();
                modal.style.cssText = "opacity:0; pointer-events: none";
                document.getElementsByTagName('body')[0].style.cssText = "overflow: auto;";
            }
        };
    }








    // Form --

    function funcionaFormU() {

        feedback = className('feedback');
        campo = className('campo');
        line_bottom = className('line_bottom');
        btn_file = id('btn_file');
        feedback_check = id('feedback_check');

        curso = id('curso');
        desc = id('desc');
        inputPlano = id('file');
        name_file = id('name_file');

        submit = id('updateUser');

        // Verificar se pode dar submit
        sucess = [];
        sucess['inputs'] = 0;

        qtdInputsGeneric = 5;
        qtdInputs = 8;
        numInputFile = 6;


        // Valida campos vazios
        for (var i = 0; i < qtdInputs; i++) {
            campoVazioU(campo[i], i);

            if (i == 1) {
                validaEmailU(campo[i], i);
            }

        }

        AttValidacaoU();

        submit.onclick = function (event) {

            // Valida campos vazios
            for (var k = 0; k < qtdInputs; k++) {
                campoVazioU(campo[k], k);

                if (k == 1) {
                    validaEmailU(campo[k], k);
                }

            }

            ValidacaoSubmitU();

            // Valida campos vazios
            for (var i = 0; i < qtdInputs; i++) {
                campoVazioU(campo[i], i);
            }

            console.log(sucess);

            if (sucess['inputs'] != 5 || sucess['email'] != 1) {
                event.preventDefault();
            }

            sucess['inputs'] = 0;
            sucess['email'] = 0;

        };

        // Ao mudar input File
        inputPlano.onchange = function (event) {
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

                    showFeedbackU("Tipo de arquivo não permitido", numInputFile);
                    btn_file.style.backgroundColor = "#ff2b41";
                    line_bottom[numInputFile].style.backgroundColor = '#ff2b41';

                    sucess['plano'] = 0;
                } else if (file.size > (1024 * 1024 * 5)) {
                    showFeedbackU("Arquivo ultrapassar 5MB", numInputFile);
                    line_bottom[numInputFile].style.backgroundColor = '#ff2b41';
                    btn_file.style.backgroundColor = "#ff2b41";

                    sucess['plano'] = 0;
                } else if (file.name == null) {
                    sucess['plano'] = 1;
                } else {
                    showFeedbackU("", numInputFile);
                    btn_file.style.backgroundColor = "#00a500";
                    line_bottom[numInputFile].style.backgroundColor = '#00a500';

                    sucess['plano'] = 1;
                }
            }
        };
    }


    function ValidacaoSubmitU() {
        for (var i = 0; i < qtdInputs; i++) {
            if (i == 0 || i == 2 || i == 3 || i == 4 || i == 5) {
                if (campo[i].value.length == 0 || campo[i].value == "" || campo[i].value == null || campo[i].value == undefined) {
                    sucess['inputs'] -= 1;
                } else {
                    sucess['inputs'] += 1;
                }
            }
        }
    }

    function validaEmailU(Campo, i) {
        if (Campo.value.match(/^[a-z]*[0-9]*@[a-z]*.com/)) {
            showFeedbackU("", i);
            line_bottom[i].style.backgroundColor = '#00a500';
            line_bottom[i].style.width = '100%';
            line_bottom[i].style.height = '2px';

            sucess['email'] = 1;

        } else {
            showFeedbackU("Formato incorreto", i);
            line_bottom[i].style.backgroundColor = '#ff2b41';
            line_bottom[i].style.width = '100%';
            line_bottom[i].style.height = '2px';

            sucess['email'] = 0;
        }

    }

    // Att Validação inputs exceto checkbox
    function AttValidacaoU() {
        for (var i = 0; i < qtdInputs; i++) {

            campo[i].onblur = function (event) {
                campoVazioU(event.currentTarget, event.currentTarget.getAttribute('data-ordem'));

                if (this.getAttribute('data-ordem') == 1) {
                    validaEmailU(this, this.getAttribute('data-ordem'));
                }
            };
        }
    }

    function campoVazioU(Campo, i) {


        // Validação não funciona para os checboxes de dias
        if (Campo.value.length == 0 || Campo.value == "" || Campo.value == null || Campo.value == undefined) {
            if (i != numInputFile) {
                showFeedbackU("Campo vazio", i);

                line_bottom[i].style.backgroundColor = '#ff2b41';
                line_bottom[i].style.width = '100%';
                line_bottom[i].style.height = '2px';
            }

        } else {
            if (i != numInputFile && i != 1) {
                showFeedbackU("", i);
                line_bottom[i].style.backgroundColor = '#00a500';
                line_bottom[i].style.width = '100%';
                line_bottom[i].style.height = '2px';
            }
        }

    }

    function showFeedbackU(Msg, Num) {
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
<script src="js/PagManutencao.js" type="text/javascript"></script>

</body>
</html>
