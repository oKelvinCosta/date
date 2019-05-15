<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 10/01/2017
 * Time: 14:30
 */
session_start();
require "../_app/class/Conexao.class.php";
require "../_app/class/Select.class.php";
require "../_app/class/Login.class.php";

$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);


$_SESSION['error'] = array();

function feedback($msg, $tipo){
    if($msg AND $tipo == 1){
        return "<div class='feedbackLoginSucess'>".$msg."</div>";
    }else if($msg AND $tipo == 2){
        return "<div class='feedbackLoginError'>".$msg."</div>";
    }
}

if( !empty($form['email']) AND !empty($form['senha']) ){



    $Login = new Login;
    $Login->exeLogin($form['email'], $form['senha']);

    // Caso de erro no login
    if($Login->getGo() == 2){
        $_SESSION['error']['Login'] = feedback($Login->getError(), 2);
        header('Location:../index.php');
    }


}else{
    $_SESSION['error']['Login'] = feedback("Prencha todos os campos.", 2);
    header('Location:../index.php');
}




