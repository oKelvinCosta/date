<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 13/01/2017
 * Time: 17:28
 */
require "../../_app/config.php";

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$_SESSION['error'] = $_FILES['foto'];


if (!empty($post['nome']) AND !empty($post['email']) AND !empty($post['unidade']) AND !empty($post['nascimento']) AND
    !empty($post['cep']) AND !empty($post['cpf']) AND !empty($post['formacao'])
) {


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
                    "nome = :nome, email = :email, unidade = :unidade, data_nasc = :data_nasc, CEP = :CEP, CPF = :CPF, formacao = :formacao, foto = :foto",
                    "WHERE id_user = :id",
                    array(
                        'nome' => $post['nome'],
                        'email' => $post['email'],
                        'unidade' => $post['unidade'],
                        'data_nasc' => date("Y-m-d", strtotime($post['nascimento'])),
                        'CEP' => $post['cep'],
                        'CPF' => $post['cpf'],
                        'formacao' => $post['formacao'],
                        'foto' => $Upload->getName(),
                        'id' => $_SESSION['id_user_click']
                    )
                );

                if($Update->getRows()){

                    $_SESSION['error'] = "Usuário atualizado com sucesso.";
                    header("Location:../../ExUsers.php");

                }else{
                    $_SESSION['error'] = "Erro ao atualizar.";
                }





            } else {
                $_SESSION['error'] = $Upload->getError();
            }

        } else {


            $Update = new Update;
            $Update->exeUpdate("usuarios",
                "nome = :nome, email = :email, unidade = :unidade, data_nasc = :data_nasc, CEP = :CEP, CPF = :CPF, formacao = :formacao",
                "WHERE id_user = :id",
                array(
                    'nome' => $post['nome'],
                    'email' => $post['email'],
                    'unidade' => $post['unidade'],
                    'data_nasc' => date("Y-m-d", strtotime($post['nascimento'])),
                    'CEP' => $post['cep'],
                    'CPF' => $post['cpf'],
                    'formacao' => $post['formacao'],
                    'id' => $_SESSION['id_user_click']
                )
            );

            if($Update->getRows()){

                    $_SESSION['error'] = "Usuário atualizado com sucesso.";
                    header("Location:../../ExUsers.php");

            }else{
                $_SESSION['error'] = $post['cpf'].$post['formacao'];
            }
        }





} else {
    $_SESSION['error'] = "Preencha todos os campos corretamente";
}







// Mostrar usuarios nao excluidos
$Select = new Select;
$Select->exeSelect("usuarios", "WHERE desligado = :des", array('des' => 1));

require "../../Parts/Usuarios.php";