<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 13/01/2017
 * Time: 17:28
 */
require "../../_app/config.php";

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);



if (!empty($post['nome']) AND !empty($post['email']) AND !empty($post['unidade']) AND !empty($post['nascimento']) AND
    !empty($post['formacao']) AND !empty($post['permicao'])
) {


    // Se Mandar foto
    if ($_FILES['foto']['name']) {

        $Upload = new Upload;
        $Upload->setImage($_FILES['foto'], 5, "Usuarios");

        // Upload
        if ($Upload->getGo() == 3) {


            // Deletar a foto antiga;
            $Select = new Select;
            $Select->exeSelect("usuarios", "WHERE id_user = :id", array('id' => $_SESSION['id_user_click']));

            $File = $Select->getResultAssoc();
            $File = $File['foto'];

            unlink("../../Uploads/Usuarios/" . $File);


            $Update = new Update;
            $Update->exeUpdate("usuarios",
                "nome = :nome,
                     email = :email,
                      unidade = :unidade,
                       data_nasc = :data_nasc,
                        formacao = :formacao,
                         foto = :foto,
                         permicao = :permicao
                         ",

                "WHERE id_user = :id",
                array(
                    'nome' => $post['nome'],
                    'email' => $post['email'],
                    'unidade' => $post['unidade'],
                    'data_nasc' => $post['nascimento'],
                    'formacao' => $post['formacao'],
                    'foto' => $Upload->getName(),
                    'permicao' => $post['permicao'],
                    'id' => $_SESSION['id_user_click']
                )
            );

            if ($post['desligado'] == 1) {
                header("Location:../../Ex_Users.php");
            }else{
                header("Location:../../Users.php");
            }


        } else {
            $_SESSION['error'] = $Upload->getError();
        }

    } else {


        $Update = new Update;
        $Update->exeUpdate("usuarios",
            "nome = :nome, 
                email = :email,
                 unidade = :unidade,
                  data_nasc = :data_nasc,
                   formacao = :formacao,
                   permicao = :permicao",
            "WHERE id_user = :id",
            array(
                'nome' => $post['nome'],
                'email' => $post['email'],
                'unidade' => $post['unidade'],
                'data_nasc' => $post['nascimento'],
                'formacao' => $post['formacao'],
                'permicao' => $post['permicao'],
                'id' => $_SESSION['id_user_click']
            )
        );

        if ($post['desligado'] == 1) {
            header("Location:../../Ex_Users.php");
        }else{
            header("Location:../../Users.php");
        }
    }


} else {
    $_SESSION['error'] = "Preencha todos os campos corretamente";
}
