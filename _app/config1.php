<?php
session_start();


function classAutoload($Class){
    if(file_exists(dirname(__FILE__).'/class/'.$Class.'.class.php')){
        require_once (dirname(__FILE__).'/class/'.$Class.'.class.php');
    }
}
spl_autoload_register("classAutoload");

function Error($Msg){
    return "<span class=\"error\">".$Msg."</span>";
}

function feedback($msg, $tipo){
    if($msg AND $tipo == 1){
        return "<div class='feedbackLoginSucess'>".$msg."</div>";
    }else if($msg AND $tipo == 2){
        return "<div class='feedbackLoginError'>".$msg."</div>";
    }
}

date_default_timezone_set('America/Sao_Paulo');
