/**
 * Created by Kelvin on 13/01/2017.
 */

// SET ----------------------------------------------------------

// Algumas variaveis setei na função, pois apos o ajax, precisa ser setada denovo

// Paginação
var container = id('container_pager');


// Pesquisa
var textH = id('textH');
var catH = id('catH');
var formH = id('MyFormH');
var calendarH = id('calendar');
var estadoH = id('estH');

var afterH = id('afterH');
var beforeH = id('beforeH');


// Modal cursos
var modal = id('modal');

// Alterar Curso
var alterar = id('alterar');
var modal_2 = id('modal_2');




// Fire ----------------------------------------------------------


// modal_Info_Cursos();

// modal_Cursos();

pesquisa();

toAfter();
toBefore();


// Functions ----------------------------------------------------------







// Pesquisa

function pesquisa() {
    catH.onchange = function () {
        loadDoc_Pesquisa_Home("back/Home/Pesquisa.php");
    };

    estadoH.onchange = function () {
        loadDoc_Pesquisa_Home("back/Home/Pesquisa.php");
    };

    textH.onkeyup = function () {
        loadDoc_Pesquisa_Home("back/Home/Pesquisa.php");
    };
}


function loadDoc_Pesquisa_Home(Url) {

    var formData = new FormData(formH);

    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            calendar.innerHTML = jax.responseText;

            // Para setar denovo as variaveis

        }
    };
    jax.open("POST", Url, true);
    jax.send(formData);
}


// Paginação


function toAfter() {
    // Enquanto a variavel não existe para não dar erro
    afterH = id('afterH');
    if (afterH) {
        afterH.onclick = function () {
            loadDocAno("back/Home/Paginacao_Ano.php?page=" + this.getAttribute('datatype'), "back/Home/Paginacao_Ano_Conteudo.php?page=" + this.getAttribute('datatype')+"&text="+textH.value+"&cat="+catH.value+"&estado="+estadoH.value);
        };
    }
}


function toBefore() {
    // Enquanto a variavel não existe para não dar erro
    beforeH = id('beforeH');
    // alert(before);

    if (beforeH) {
        beforeH.onclick = function () {
            loadDocAno("back/Home/Paginacao_Ano.php?page=" + this.getAttribute('datatype'), "back/Home/Paginacao_Ano_Conteudo.php?page=" + this.getAttribute('datatype')+"&text="+textH.value+"&cat="+catH.value+"&estado="+estadoH.value);
        };
    }
}


function loadDocAno(Url, Url2) {

    // Paginação do ano
    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            container.innerHTML = jax.responseText;

            // Para setar denovo as variaveis


            toAfter();
            toBefore();

        }
    };
    jax.open("GET", Url, true);
    jax.send();


    // Muda o conteúdo dos calendários
    var jaxContent = new XMLHttpRequest;
    jaxContent.onreadystatechange = function () {
        if (jaxContent.readyState == 4 && jaxContent.status == 200) {

            calendar.innerHTML = jaxContent.responseText;

            // Para setar denovo as variaveis

        }
    };
    jaxContent.open("GET", Url2, true);
    jaxContent.send();
}


function id(id) {
    return document.getElementById(id);
}


function className(className) {
    return document.getElementsByClassName(className);
}