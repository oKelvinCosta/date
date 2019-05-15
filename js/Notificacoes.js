// SET ----------------------------------------------------------

var notions = className('notions');

// Modal cursos
var modal = id('modal');


// FIRE ----------------------------------------------------------


open_Modal_Editar_Curso_toAdm();


// FUNCTIONS ----------------------------------------------------------


// 1 Abrir Modal Editar curso
function open_Modal_Editar_Curso_toAdm() {
    notions = className('notions');
    for (var i = 0; notions[i]; i++) {
        notions[i].onclick = function (event) {

            loadDoc_Open_Modal_Editar_Curso_toAdm("back/Modal_Editar_Curso_toAdm.php?idCurso=" + this.getAttribute('data-id_curso-type') + "&identify=" + this.getAttribute('data-id_curso-type'));

            // Ao clicar para ver fecha side

            event.preventDefault();
            event.stopPropagation();

            menu_highlight.style.opacity = '0';
            menu_highlight.style.top = 'auto';
            menu_highlight.style.left = 'auto';
            menu_highlight.style.right = 'auto';
            menu_highlight.style.bottom = 'auto';
            menu_highlight.style.pointerEvents = 'none';

            cSide.style.right = '-100%';
            toggle.style.right = '-100%';

        };
    }

}

function loadDoc_Open_Modal_Editar_Curso_toAdm(Url) {
    var jax = new XMLHttpRequest;
    jax.onreadystatechange = function () {
        if (jax.readyState == 4 && jax.status == 200) {
            console.log(jax.responseText);
            modal_2.innerHTML = jax.responseText;
            modal_2.style.cssText = "opacity:1; pointer-events: auto";

            open_Modal_Editar_Curso_toAdm();


                // Refutar // Aprovar // Att
                funcionaForm();

            // Fechar
            fecha_Modal();
        }
    };
    jax.open("GET", Url, true);
    jax.send();
}


// ANOTAR
// Funções de outro arquivo nao fucionam neste, ao menos que no html linke os 2

// Fechar modal
function fecha_Modal() {
    var body = document.body;

    var modal_off = id('modal_off');
    var modal_off_2 = id('modal_off_2');

    window.onclick = function () {
        if (event.target == modal_off) {
            // Remove o conteúdo da modal
            modal_off.remove();
            modal.style.cssText = "opacity:0; pointer-events: none";
        } else if (event.target == modal_off_2) {
            // Remove o conteúdo da modal
            modal_off_2.remove();
            modal_2.style.cssText = "opacity:0; pointer-events: none";
        }
        body.style.overflow = 'auto';

    };
}


function id(id) {
    return document.getElementById(id);
}


function className(className) {
    return document.getElementsByClassName(className);
}