//######################  EDIT PELAS NOTIFICAÇÕES


/**
 * Created by Kelvin on 21/01/2017.
 */
// SET ----------------------------------------------------------

var manutencao_container = id('manutencao_container');

var editar = className('editar');

//Pesquisa
var text = id('text');
var cat = id('cat');
var statuetas = id('statuetas');
var estado = id('estado');

// Paginacao
var container_pager = id('container_pager');
var after = id('after');
var before = id('before');

var add_alun = className('add_alun');
var sub_alun = className('sub_alun');
var alun_atual = className('alun_atual');

// FIRE ----------------------------------------------------------
beforePaginacao();

afterPaginacao();

Pesquisa();

open_Modal_Editar_Curso();

aprovar_Direct();

refutar_Direct();


Add_Qtd_Alun();

Sub_Qtd_Alun();

// FUNCTIONS ----------------------------------------------------------

// Add Qtd Alunos

function Add_Qtd_Alun() {

    add_alun = className('add_alun');


    if (add_alun) {
        for (var i = 0; add_alun[i]; i++) {
            add_alun[i].onclick = function(){
                // Acao = 1
              loadDoc_Add_Qtd_Alun("back/Manutencao_Cursos/Qtd_Alunos.php?Acao=1&idCurso="+this.getAttribute("data-id"),this.getAttribute("data-id"));
            };
        }
    }
}

function Sub_Qtd_Alun() {

    sub_alun = className('sub_alun');

    if (sub_alun) {
        for (var i = 0; sub_alun[i]; i++) {
            sub_alun[i].onclick = function(){
                // Acao = 2
                loadDoc_Add_Qtd_Alun("back/Manutencao_Cursos/Qtd_Alunos.php?Acao=2&idCurso="+this.getAttribute("data-id"), this.getAttribute("data-id"));
            };
        }
    }
}

function loadDoc_Add_Qtd_Alun(Url, Id) {
    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            alun_atual = className('alun_atual');

                for (var i = 0; alun_atual[i]; i++) {
                    if(Id == alun_atual[i].getAttribute('data-id')){
                        alun_atual[i].innerHTML = jax.responseText;
                    }
                }


        }
    };
    jax.open("GET", Url, true);
    jax.send();
}


// Paginação
function beforePaginacao() {
    before = id('before');
    if (before) {
        before.onclick = function () {

            // Att novo ano
            loadDoc_Paginacao_Ano("back/Manutencao_Cursos/Paginacao_Ano.php?page=" + this.getAttribute('datatype'));
            // Att Conteudo
            loadDoc_Paginacao_Conteudo("back/Manutencao_Cursos/Paginacao_Conteudo.php?page=" + this.getAttribute('datatype'));
        };
    }
}

function afterPaginacao() {
    after = id('after');
    if (after) {
        after.onclick = function () {

            // Att novo ano
            loadDoc_Paginacao_Ano("back/Manutencao_Cursos/Paginacao_Ano.php?page=" + this.getAttribute('datatype'));
            // Att Conteudo
            loadDoc_Paginacao_Conteudo("back/Manutencao_Cursos/Paginacao_Conteudo.php?page=" + this.getAttribute('datatype'));
        };
    }
}

function loadDoc_Paginacao_Ano(Url) {
    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            container_pager.innerHTML = jax.responseText;

            afterPaginacao();
            beforePaginacao();

        }
    };
    jax.open("GET", Url, true);
    jax.send();
}

function loadDoc_Paginacao_Conteudo(Url) {
    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            if (manutencao_container) {
                manutencao_container.innerHTML = jax.responseText;

                Add_Qtd_Alun();

                Sub_Qtd_Alun();

                open_Modal_Editar_Curso();

                aprovar_Direct();

                refutar_Direct();
            }



        }
    };
    jax.open("GET", Url, true);
    jax.send();
}


// Pesquisa
function Pesquisa() {
    if (statuetas) {
        text.onkeyup = function () {
            loadDoc_Pesquisa("back/Manutencao_Cursos/Pesquisa.php");
        };

        cat.onchange = function () {
            loadDoc_Pesquisa("back/Manutencao_Cursos/Pesquisa.php");
        };

        statuetas.onchange = function () {
            loadDoc_Pesquisa("back/Manutencao_Cursos/Pesquisa.php");
        };

        estado.onchange = function () {
            loadDoc_Pesquisa("back/Manutencao_Cursos/Pesquisa.php");
        };
    }
}


function loadDoc_Pesquisa(Url) {
    var form = id('MyFormManu');
    var formData = new FormData(form);

    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            if (manutencao_container) {
                manutencao_container.innerHTML = jax.responseText;
                aprovar_Direct();
                refutar_Direct();
                open_Modal_Editar_Curso();

                Add_Qtd_Alun();

                Sub_Qtd_Alun();
            }

        }
    };
    jax.open('POST', Url, true);
    jax.send(formData);
}


//#### ATT NOTIFICATIONS AND MANUTENCAO CONTEUDO #####


// Abrir Modal Update
function open_Modal_Editar_Curso() {
    editar = className('editar');
    for (var i = 0; editar[i]; i++) {
        editar[i].onclick = function () {

            // from Notificações
            loadDoc_Modal_Editar_Curso("back/Modal_Editar_Curso_toAdm.php?idCurso=" + this.getAttribute("data-curso_id-type"));
            // Esta abrindo modal info depois do submit ########
            // Att Conteudo #######

        };
    }
}

function loadDoc_Modal_Editar_Curso(Url) {
    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            modal_2.innerHTML = jax.responseText;
            modal_2.style.cssText = "opacity:1; pointer-events: auto";

            // Acionador do update
            // Editar_Curso();

            fecha_Modal();

            funcionaForm();
        }
    };
    jax.open("GET", Url, true);
    jax.send();
}


function loadDoc_AttSide(Url) {

    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            // Att Notificações
            var conteiner_notificacao = id('conteiner_notificacao');
            conteiner_notificacao.innerHTML = jax.responseText;
            console.log('bug: eee');

            // Para reabrir Modal - Notificacoes
            open_Modal_Editar_Curso_toAdm();

        }
    };
    jax.open("GET", Url, true);
    jax.send();
}


function loadDoc_AttSideNot(Url) {

    var count_not = id('count_not');

    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            // Att ICON Notificações
            count_not.innerHTML = jax.responseText;
            console.log('bug: aside numeros: '+ jax.responseText);
            Menus();

        }
    };
    jax.open("GET", Url, true);
    jax.send();
}


function loadDoc_Editar_Curso(Url) {

    var form = id('MyFormEditarCurso');
    var formData = new FormData(form);

    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            // No caso de usar esse arquivo em outras paginass
            if (manutencao_container) {
                manutencao_container.innerHTML = jax.responseText;

                aprovar_Direct();
                refutar_Direct();

                Add_Qtd_Alun();

                Sub_Qtd_Alun();
            }


            modal_2.style.cssText = "opacity:0; pointer-events: none";

            var modal_off_2 = id('modal_off_2');
            modal_off_2.remove();


            open_Modal_Editar_Curso();
        }
    };
    jax.open("POST", Url, true);
    jax.send(formData);
}


// Aprovar / Refutar
function refutar_Direct() {
    var refutar = className('refutar');

    for (var i = 0; refutar[i]; i++) {
        refutar[i].onclick = function () {
            // Refuta curso e att Side Menu
            loadDoc_Aprovar_Curso_toAdm("back/Status_Curso.php?status=2&idCurso=" + this.getAttribute('data-curso_id-type') + "&tipoCancelamento=" + this.getAttribute('data-cancelamento'));
            fecha_Modal();
            // Att Conteudo #######
        };
    }
}

function aprovar_Direct() {
    var aprovar = className('aprovar');

    for (var i = 0; aprovar[i]; i++) {
        aprovar[i].onclick = function () {
            // Aprova curso e att Side Menu
            loadDoc_Aprovar_Curso_toAdm("back/Status_Curso.php?status=1&idCurso=" + this.getAttribute('data-curso_id-type') + "&tipoAprovacao=" + this.getAttribute('data-aprovacao'));
            // Att Conteudo #######
        };
    }
}

function loadDoc_Aprovar_Curso_toAdm(Url) {

    // Funcionalide e Att Manutencao
    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            // Att Conteudo
            // No caso de usar esse arquivo em outras paginass
            if (manutencao_container) {
                manutencao_container.innerHTML = jax.responseText;

                aprovar_Direct();
                refutar_Direct();

                Add_Qtd_Alun();

                Sub_Qtd_Alun();
            }
            open_Modal_Editar_Curso();

            // Att Notificações
            loadDoc_AttSide("back/Manutencao_Cursos/Side.php");

            // Att ICON Notificações
            loadDoc_AttSideNot("back/Manutencao_Cursos/Side_Notify.php");

        }
    };
    jax.open("GET", Url, true);
    jax.send();

}


// Att Calendar
function loadDoc_Editar_Curso_Att_Calendar(Url) {

    var form = id('MyFormEditarCurso');
    var formData = new FormData(form);

    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            var calendar = id('calendar');

            // No caso de usar esse arquivo em outras paginass
            if (calendar) {
                calendar.innerHTML = jax.responseText;
            }

            if (modal_2) {
                modal_2.style.cssText = "opacity:0; pointer-events: none";
            }
            if (modal_off_2) {
                var modal_off_2 = id('modal_off_2');
                modal_off_2.remove();
            }

            open_Modal_Editar_Curso();
        }
    };
    jax.open("get", Url, true);
    jax.send();
}

// Att Calendar Detalhado
function loadDoc_Editar_Curso_Att_Calendar_Detalhado(Url) {

    var form = id('MyFormEditarCurso');
    var formData = new FormData(form);

    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            var container_dias = id('container_dias');

            // No caso de usar esse arquivo em outras paginass
            if (container_dias) {
                container_dias.innerHTML = jax.responseText;
            }

            if (modal_2) {
                modal_2.style.cssText = "opacity:0; pointer-events: none";
            }
            if (modal_off_2) {
                var modal_off_2 = id('modal_off_2');
                modal_off_2.remove();
            }

            open_Modal_Editar_Curso();
        }
    };
    jax.open("get", Url, true);
    jax.send();
}


// --


// Form Validation

function funcionaForm() {
    console.log('bug5');

    submit_refutar = id('submit_refutar');
    submitAdd = id('submit');


    feedback = className('feedback');
    campo = className('campo');
    line_bottom = className('line_bottom');
    btn_file = id('btn_file');
    feedback_check = id('feedback_check');

    checkboxes = document.getElementsByName('dias[]');
    curso = id('curso');
    cargaH = id('carga_h');
    desc = id('desc');
    inputPlano = id('file');
    name_file = id('name_file');

    error = 0;

// Verificar se pode dar submit
    sucess = [];
    sucess['inputs'] = 0;
    sucess['plano'] = 1;
    sucess['capa'] = 1;


    qtdInputsGeneric = 10;
    qtdInputs = 16;
    numInputFile = 11;

    btnCapa = id('btn_capa');
    textCapa = id('name_capa');
    inputCapa = id('capa');
    numCapa = 13;

    verde = '#2cb92c';
    vermelho = '#ff2b41';

// __3 Situações de Validação
// Inputs, text, date, selec
// Inputs checkbox
// Inputs file com o text


    validaCheckbox();

    for (var i = 0; i < qtdInputs; i++) {
        if(campo[i]){
            AttValidacao();
        }
    }



    // Valida campos vazios
    for (var i = 0; i < qtdInputs; i++) {
        campoVazio(campo[i], i);
    }

    if (submit_refutar) {
        submit_refutar.onclick = function () {

            event.preventDefault();

            // Att Notifications

            // Refutar
            loadDoc_Aprovar_Curso_toAdm("back/Status_Curso.php?status=2&idCurso=" + this.getAttribute('data-id_curso') + "&tipoCancelamento=2");

            // Att Conteúdo e Aprovação Pag Manutenção
            loadDoc_Editar_Curso("back/Update_Curso_toAdm.php");

            // Att Notificações
            loadDoc_AttSide("back/Manutencao_Cursos/Side.php");

            // Att ICON Notificações
            loadDoc_AttSideNot("back/Manutencao_Cursos/Side_Notify.php");


        };
    }




    submitAdd.onclick = function () {

        ValidacaoSubmit();

        // Att Validação Checkbox ao dar submit
        var check = 0;
        for (var h = 0; h < checkboxes.length; h++) {
            if (checkboxes[h].checked) {
                check += 1;
            }
        }
        // Se nenhum for check
        if (check == 0) {
            feedback_check.innerHTML = "Nenhum dia selecionado";
            sucess['checkbox'] = 0;
        } else {
            feedback_check.innerHTML = "";
            sucess['checkbox'] = 1;
        }

        // Valida campos vazios
        for (var i = 0; i < qtdInputs; i++) {
            campoVazio(campo[i], i);
        }


        if (sucess['inputs'] != qtdInputsGeneric || sucess['checkbox'] != 1 || sucess['plano'] != 1 || sucess['data'] != 1 || sucess['capa'] != 1) {
            event.preventDefault();
        } else {
            console.log(sucess);

            event.preventDefault();


            // Att Conteúdo
            loadDoc_Editar_Curso("back/Update_Curso_toAdm.php");




            // Esse codigo roda antes de efetuar o update dos cursos, então é preciso atrasar ate q o update seja feito
            setTimeout(function () {

                // Att Calendar
                loadDoc_Editar_Curso_Att_Calendar("back/Home/Pesquisa.php");

                // Att Calendar Detalhado
                loadDoc_Editar_Curso_Att_Calendar_Detalhado("back/Calendar/Pesquisa.php");

                // Att ICON Notificações
                loadDoc_AttSideNot("back/Manutencao_Cursos/Side_Notify.php");

                // Att Notificações
                loadDoc_AttSide("back/Manutencao_Cursos/Side.php");

            }, 500);

        }

        sucess['inputs'] = 0;

    };



// Ao mudar input File
    inputPlano.onchange = function () {
        console.log('bug1');
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
                console.log('bug2');

                sucess['plano'] = 0;
            } else if (file.size > (1024 * 1024 * 5)) {
                showFeedback("Arquivo ultrapassar 5MB", numInputFile);
                line_bottom[numInputFile].style.backgroundColor = vermelho;
                btn_file.style.backgroundColor = "#ff2b41";
                console.log('bug3');

                sucess['plano'] = 0;
            } else {
                showFeedback("", numInputFile);
                btn_file.style.backgroundColor = "#00a500";
                line_bottom[numInputFile].style.backgroundColor = '#00a500';

                sucess['plano'] = 1;
                console.log('bug4');
            }
        }
    };



    inputCapa.onchange = function () {

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




}


// FUNCTIONS ----------------------------------


function ValidacaoSubmit() {
    for (var i = 0; i < qtdInputs; i++) {
        if (i == 0 || i == 1 || i == 4 || i == 5 || i == 6 || i == 7 || i == 8 || i == 9 || i == 10 || i == 15) {

            if (campo[i].value.length == 0 || campo[i].value == "" || campo[i].value == null || campo[i].value == undefined || campo[i].value == 0) {
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
        if(campo[i]){
            campo[i].onblur = function () {
                campoVazio(this, this.getAttribute('data-ordem'));
            };
        }
    }
}

// Valida Att checkbox
function validaCheckbox() {

    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].onchange = function () {
            var check = 0;
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    check += 1;
                }
            }

            // Se nenhum for check
            if (check == 0) {
                feedback_check.innerHTML = "Nenhum dia selecionado";
                sucess['checkbox'] = 0;
            } else {
                feedback_check.innerHTML = "";
                sucess['checkbox'] = 1;
            }
        };
    }
}


function campoVazio(Campo, i) {

    if(Campo){


    // Validação não funciona para os checboxes de dias
    if (Campo.value.length == 0 || Campo.value == "" || Campo.value == null || Campo.value == undefined || campo[i].value == 0) {

        console.log(i);
        // Plano de curso = 11
        // capa = 13

        if( i == 11 && Campo.getAttribute('data-exists') == 2){
            showFeedback("Campo vazio bug", i);

            line_bottom[i].style.backgroundColor = vermelho;
            line_bottom[i].style.width = '100%';
            line_bottom[i].style.height = '2px';
            sucess['plano'] = 0;
        }

        // Se não for os input file
        if (i != numInputFile && i != numInputFile + 1 && i != numCapa && i != numCapa + 1) {
            showFeedback("Campo vazio", i);

            line_bottom[i].style.backgroundColor = vermelho;
            line_bottom[i].style.width = '100%';
            line_bottom[i].style.height = '2px';

        }


    } else if (i == 3 || i == 2) {
        // Compara Datas

        var ini = campo[2].value;
        var fini = campo[3].value;

        if (ini && fini) {
            if (ini > fini) {
                showFeedback("Data incorreta", 2);
                line_bottom[2].style.backgroundColor = vermelho;
                line_bottom[2].style.width = '100%';
                line_bottom[2].style.height = '2px';

                showFeedback("Data incorreta", 3);
                line_bottom[3].style.backgroundColor = vermelho;
                line_bottom[3].style.width = '100%';
                line_bottom[3].style.height = '2px';

                sucess['data'] = 0;
            } else {
                showFeedback("", 2);
                line_bottom[2].style.backgroundColor = '#00a500';
                line_bottom[2].style.width = '100%';
                line_bottom[2].style.height = '2px';

                showFeedback("", 3);
                line_bottom[3].style.backgroundColor = '#00a500';
                line_bottom[3].style.width = '100%';
                line_bottom[3].style.height = '2px';

                sucess['data'] = 1;
            }
        } else if (ini) {
            showFeedback("", 2);
            line_bottom[2].style.backgroundColor = '#00a500';
            line_bottom[2].style.width = '100%';
            line_bottom[2].style.height = '2px';
        } else if (fini) {
            showFeedback("", 3);
            line_bottom[3].style.backgroundColor = '#00a500';
            line_bottom[3].style.width = '100%';
            line_bottom[3].style.height = '2px';
        }


    } else {
        if (i != numInputFile && i != numInputFile + 1 && i != numCapa && i != numCapa + 1) {
            showFeedback("", i);
            line_bottom[i].style.backgroundColor = '#00a500';
            line_bottom[i].style.width = '100%';
            line_bottom[i].style.height = '2px';
        }
    }

    }


}


function showFeedback(Msg, Num) {
    if (feedback[Num]) {
        feedback[Num].innerHTML = Msg;
    }
}


function id(id) {
    return document.getElementById(id);
}


function className(className) {
    return document.getElementsByClassName(className);
}
