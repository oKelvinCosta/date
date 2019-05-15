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
              loadDoc_Add_Qtd_Alun("back/Manutencao_Cursos_Basico/Qtd_Alunos.php?Acao=1&idCurso="+this.getAttribute("data-id"), this.getAttribute("data-id"));
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
                loadDoc_Add_Qtd_Alun("back/Manutencao_Cursos_Basico/Qtd_Alunos.php?Acao=2&idCurso="+this.getAttribute("data-id"),  this.getAttribute("data-id"));
            };
        }
    }
}

function loadDoc_Add_Qtd_Alun(Url, Id) {
    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            // Caso precise ser setado novamente
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
            loadDoc_Paginacao_Ano("back/Manutencao_Cursos_Basico/Paginacao_Ano.php?page=" + this.getAttribute('datatype'));
            // Att Conteudo
            loadDoc_Paginacao_Conteudo("back/Manutencao_Cursos_Basico/Paginacao_Conteudo.php?page=" + this.getAttribute('datatype'));
        };
    }
}

function afterPaginacao() {
    after = id('after');
    if (after) {
        after.onclick = function () {

            // Att novo ano
            loadDoc_Paginacao_Ano("back/Manutencao_Cursos_Basico/Paginacao_Ano.php?page=" + this.getAttribute('datatype'));
            // Att Conteudo
            loadDoc_Paginacao_Conteudo("back/Manutencao_Cursos_Basico/Paginacao_Conteudo.php?page=" + this.getAttribute('datatype'));
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
            }

        }
    };
    jax.open("GET", Url, true);
    jax.send();
}



// Pesquisa
function Pesquisa() {
    if (cat) {
        text.onkeyup = function () {
            loadDoc_Pesquisa("back/Manutencao_Cursos_Basico/Pesquisa.php");
        };

        cat.onchange = function () {
            loadDoc_Pesquisa("back/Manutencao_Cursos_Basico/Pesquisa.php");
        };

        estado.onchange = function () {
            loadDoc_Pesquisa("back/Manutencao_Cursos_Basico/Pesquisa.php");
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

                Add_Qtd_Alun();

                Sub_Qtd_Alun();
            }

        }
    };
    jax.open('POST', Url, true);
    jax.send(formData);
}




function id(id) {
    return document.getElementById(id);
}


function className(className) {
    return document.getElementsByClassName(className);
}
