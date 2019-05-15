<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 07/03/2017
 * Time: 18:42
 */

//
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if( !empty($form['idu']) AND !empty($form['senha']) AND !empty($form['csenha']) ){

    if($form['senha'] == $form['csenha']){
        // Faz o update

        $Senha = md5($form['senha']);

        $Update = new Update;
        $Update->exeUpdate("users", "senha = :senha", "WHERE id_user = :id", ['senha'=> $Senha,'id'=>$form['idU']]);

    }else{
        // Volta
    }

}else{
    // Volta
}