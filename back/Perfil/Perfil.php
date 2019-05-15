<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 13/01/2017
 * Time: 17:28
 */
require "../../_app/config.php";

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);



$_SESSION['error'] = array();

if (!empty($post['nome']) AND !empty($post['email']) AND !empty($post['unidade']) AND !empty($post['nascimento']) AND
    !empty($post['formacao'])
) {


    if ($_FILES['foto']['name']) {

        $Upload = new Upload;
        $Upload->setImage($_FILES['foto'], 5, "Usuarios");

        // Upload
        if ($Upload->getGo() == 3) {


            // Deletar a foto antiga;
            $Select = new Select;
            $Select->exeSelect("usuarios", "WHERE id_user = :id", array('id' => $_SESSION['user']['id']));


            $File = $Select->getResultAssoc();

            $_SESSION['user']['nome'] = $File['nome'];
            $_SESSION['user']['id'] = $File['id_user'];
            $_SESSION['user']['email'] = $File['email'];
            $_SESSION['user']['permicao'] = $File['permicao'];
            $_SESSION['user']['foto'] = $File['foto'];

            $File = $File['foto'];

            unlink("../../Uploads/Usuarios/" . $File);


            $Update = new Update;
            $Update->exeUpdate("usuarios",
                "nome = :nome,
                     email = :email,
                      unidade = :unidade,
                       data_nasc = :data_nasc,
                        formacao = :formacao,
                         foto = :foto
                         ",

                "WHERE id_user = :id",
                array(
                    'nome' => $post['nome'],
                    'email' => $post['email'],
                    'unidade' => $post['unidade'],
                    'data_nasc' => $post['nascimento'],
                    'formacao' => $post['formacao'],
                    'foto' => $Upload->getName(),
                    'id' => $_SESSION['user']['id']
                )
            );

            if ($Update->getRows()) {

                $_SESSION['error']['Perfil'] = feedback_Submit("Atualizado com sucesso", "success");
                    header("Location:../../Perfil.php");


            } else {
                $_SESSION['error']['Perfil'] = feedback_Submit("Erro ao atualizar, tente novamente", "erro");
                header("Location:../../Perfil.php");
            }


        } else {
            $_SESSION['error']['Perfil'] = feedback_Submit($Upload->getError(), "erro");

        }

    } else {

        // Deletar a foto antiga;
        $Select = new Select;
        $Select->exeSelect("usuarios", "WHERE id_user = :id", array('id' => $_SESSION['user']['id']));


        $File = $Select->getResultAssoc();

        $_SESSION['user']['nome'] = $File['nome'];
        $_SESSION['user']['id'] = $File['id_user'];
        $_SESSION['user']['email'] = $File['email'];
        $_SESSION['user']['permicao'] = $File['permicao'];
        $_SESSION['user']['foto'] = $File['foto'];


        $Update = new Update;
        $Update->exeUpdate("usuarios",
            "nome = :nome, 
                email = :email,
                 unidade = :unidade,
                  data_nasc = :data_nasc,
                   formacao = :formacao
                   ",
            "WHERE id_user = :id",
            array(
                'nome' => $post['nome'],
                'email' => $post['email'],
                'unidade' => $post['unidade'],
                'data_nasc' => $post['nascimento'],
                'formacao' => $post['formacao'],
                'id' => $_SESSION['user']['id']
            )
        );

        if ($Update->getRows()) {

            $_SESSION['error']['Perfil'] = feedback_Submit("Atualizado com sucesso", "success");
                header("Location:../../Perfil.php");

        } else {
            header("Location:../../Perfil.php");
            $_SESSION['error']['Perfil'] = feedback_Submit("Erro ao atualizar, tente novamente", "erro");
        }
    }


} else {
    $_SESSION['error']['Perfil'] = feedback_Submit("Preencha todos os campos corretamente", "erro");
}

// Seta o novo nome
$Select = new Select;
$Select->exeSelect("usuarios", "WHERE id_user = :id", array('id' => $_SESSION['user']['id']));


$File = $Select->getResultAssoc();

$_SESSION['user']['nome'] = $File['nome'];
$_SESSION['user']['id'] = $File['id_user'];
$_SESSION['user']['email'] = $File['email'];
$_SESSION['user']['permicao'] = $File['permicao'];
$_SESSION['user']['foto'] = $File['foto'];


function feedback_Submit($msg, $class){
    return "<div id='feedback_Submit' class='{$class}'>{$msg}</div>";
}