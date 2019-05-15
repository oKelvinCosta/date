/**
 * Created by Kelvin on 08/02/2017.
 */


Menus();


function Menus() {

    var body = document.body;

// Aciona Menu
     toMenu = id('toMenu');

// Menu
     toggle = className('toggle')[0];

// Side
     cSide = className('side')[0];

//Aciona Side
     side = className('icon_notifica')[0];


// Highlight
     menu_highlight = id('menu_highlight');




    if(side && cSide){
        side.onclick = function (event) {

            event.preventDefault();
            event.stopPropagation();

            menu_highlight.style.opacity = '1';
            menu_highlight.style.pointerEvents = 'auto';
            menu_highlight.style.top = '0';
            menu_highlight.style.left = '0';
            menu_highlight.style.right = '0';
            menu_highlight.style.bottom = '0';

            cSide.style.right = '0%';
            body.style.overflow = 'hidden';

        };

        cSide.onclick = function (event) {
            event.preventDefault();
            event.stopPropagation();
        };
    }



        toMenu.onclick = function (event) {
            body.style.overflow = 'hidden';

            event.preventDefault();
            event.stopPropagation();

            menu_highlight.style.opacity = '1';
            menu_highlight.style.pointerEvents = 'auto';
            menu_highlight.style.top = '0';
            menu_highlight.style.left = '0';
            menu_highlight.style.right = '0';
            menu_highlight.style.bottom = '0';

            toggle.style.right = '0%';

        };




    toggle.onclick = function (event) {

        event.stopPropagation();
    };




        menu_highlight.onclick = function (event) {

            body.style.overflow = 'auto';

            event.preventDefault();
            event.stopPropagation();

            menu_highlight.style.opacity = '0';
            menu_highlight.style.top = 'auto';
            menu_highlight.style.left = 'auto';
            menu_highlight.style.right = 'auto';
            menu_highlight.style.bottom = 'auto';
            menu_highlight.style.pointerEvents = 'none';

            if(cSide){
                cSide.style.right = '-100%';
            }
            toggle.style.right = '-100%';
        };








}





























function id(id) {
    return document.getElementById(id);
}


function className(className) {
    return document.getElementsByClassName(className);
}
