/**
 * Created by Kelvin on 13/01/2017.
 */

// SET ----------------------------------------------------------

// Pesquisa
var container_dias = id('container_dias');
var formC = id('MyFormC');
var catC = id('catC');
var textC = id('textC');
var numDiaC = id('numDiaC');
var diaSemanaC = id('diaSemanaC');
var estadoC = id('estC');

// Paginação Mes
var containerM = id('container_pager_mes');
var afterM = id('afterMes');
var beforeM = id('beforeMes');


// Paginação Ano
var containerAno = id('container_pager_ano');
var after = id('after');
var before = id('before');


// FIRE ----------------------------------------------------------

toAfter();

toBefore();

toAfterM();

toBeforeM();

pesquisa();



// Functions ----------------------------------------------------------







// Paginação MES

function toAfterM() {
    
    // Enquanto a variavel não existe para não dar erro
    if (afterM) {
        afterM.onclick = function () {
            loadDocMes("back/Calendar/Paginacao_Mes.php?page=" + this.getAttribute('datatype'), "back/Calendar/Paginacao_Mes_Conteudo.php?page=" + this.getAttribute('datatype')+"&cat="+catC.value+"&text="+textC.value+"&numDia="+numDiaC.value+"&diaSemana="+diaSemanaC.value+"&estado="+estadoC.value );
        };
    }
}


function toBeforeM() {
    // Enquanto a variavel não existe para não dar erro
    if (beforeM) {
        beforeM.onclick = function () {
            loadDocMes("back/Calendar/Paginacao_Mes.php?page=" + this.getAttribute('datatype'),
                "back/Calendar/Paginacao_Mes_Conteudo.php?page=" + this.getAttribute('datatype')+"&cat="+catC.value+"&text="+textC.value+"&numDia="+numDiaC.value+"&diaSemana="+diaSemanaC.value+"&estado="+estadoC.value );
        };
    }
}



function loadDocMes(Url, Url2) {

    // Paginação do ano
    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            containerM.innerHTML = jax.responseText;

            // Para setar denovo as variaveis

            afterM = id('afterMes');
            beforeM = id('beforeMes');

            toAfterM();
            toBeforeM();

        }
    };
    jax.open("GET", Url, true);
    jax.send();


    // Muda o conteúdo dos calendários
    var jaxContent = new XMLHttpRequest;
    jaxContent.onreadystatechange = function () {
        if (jaxContent.readyState == 4 && jaxContent.status == 200) {

            container_dias.innerHTML = jaxContent.responseText;

        }
    };
    jaxContent.open("GET", Url2, true);
    jaxContent.send();
    
}

// Paginacao ANO


function toAfter() {
    // Enquanto a variavel não existe para não dar erro
    if (after) {
        after.onclick = function () {
            loadDocAno("back/Calendar/Paginacao_Ano.php?page=" + this.getAttribute('datatype'),
                "back/Calendar/Paginacao_Ano_Conteudo.php?page=" + this.getAttribute('datatype')+"&cat="+catC.value+"&text="+textC.value+"&numDia="+numDiaC.value+"&diaSemana="+diaSemanaC.value+"&estado="+estadoC.value );
        };
    }
}


function toBefore() {
    // Enquanto a variavel não existe para não dar erro
    if (before) {
        before.onclick = function () {
            loadDocAno("back/Calendar/Paginacao_Ano.php?page=" + this.getAttribute('datatype'),
                "back/Calendar/Paginacao_Ano_Conteudo.php?page=" + this.getAttribute('datatype')+"&cat="+catC.value+"&text="+textC.value+"&numDia="+numDiaC.value+"&diaSemana="+diaSemanaC.value+"&estado="+estadoC.value );
        };
    }
}

function loadDocAno(Url, Url2) {

    // Paginação do ano
    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            containerAno.innerHTML = jax.responseText;

            // Para setar denovo as variaveis

            after = id('after');
            before = id('before');

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

            container_dias.innerHTML = jaxContent.responseText;

        }
    };
    jaxContent.open("GET", Url2, true);
    jaxContent.send();
}




// Pesquisa

function pesquisa() {

    estadoC.onchange = function () {
        loadDoc_Pesquisa_Calendar("back/Calendar/Pesquisa.php");
    };

    diaSemanaC.onchange = function () {
        loadDoc_Pesquisa_Calendar("back/Calendar/Pesquisa.php");
    };

    numDiaC.onchange = function () {
        loadDoc_Pesquisa_Calendar("back/Calendar/Pesquisa.php");
    };
    numDiaC.onkeyup = function () {
        loadDoc_Pesquisa_Calendar("back/Calendar/Pesquisa.php");
    };

    catC.onchange = function () {
        loadDoc_Pesquisa_Calendar("back/Calendar/Pesquisa.php");
    };

    textC.onkeyup = function () {
        loadDoc_Pesquisa_Calendar("back/Calendar/Pesquisa.php");
    };
}


function loadDoc_Pesquisa_Calendar(Url) {

    var formData = new FormData(formC);

    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {

            container_dias.innerHTML = jax.responseText;

        }
    };
    jax.open("POST", Url, true);
    jax.send(formData);
}



function id(id) {
    return document.getElementById(id);
}


function className(className) {
    return document.getElementsByClassName(className);
}
