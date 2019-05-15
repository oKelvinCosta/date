<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 13/01/2017
 * Time: 17:28
 */
require "../_app/config.php";

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$_SESSION['error'] = array();

if( !empty($post['nome']) AND !empty($post['email']) AND !empty($post['unidade']) AND !empty($post['nascimento']) AND
    !empty($post['senha']) AND !empty($post['csenha']) AND !empty($post['formacao']) AND
    !empty($_FILES['foto']['name']) AND !empty($post['permicao']) ){

    $Upload = new Upload;
    $Upload->setImage($_FILES['foto'], 5, "Usuarios", "../Uploads");

    // Upload
    if($Upload->getGo() == 3){

        // Senha correta
        if($post['senha'] == $post['csenha']){

            $senha = md5($post['senha']);

            $Insert = new Insert;
            $Insert->exeInsert("usuarios",
                array(
                    'nome' => $post['nome'],
                    'email' => $post['email'],
                    'unidade' => $post['unidade'],
                    'data_nasc' => $post['nascimento'],
                    'senha' => $senha,
                    'formacao' => $post['formacao'],
                    'foto' => $Upload->getName(),
                    'permicao' =>$post['permicao']

                ));

            if($Insert->getLastId()){
                $_SESSION['error']['Add_User'] = feedback_Submit("Usuário cadastrado com sucesso", "success");
                header("Location:../Add_User.php");

            }else{
                $_SESSION['error']['Add_User'] = feedback_Submit("Erro ao cadastrar, tente novamente", "erro");
                header("Location:../Add_User.php");
            }

        }else{
            $_SESSION['error']['Add_User'] = feedback_Submit("Confirme a senha corretamente", "erro");
            header("Location:../Add_User.php");
        }

    }else{
        $_SESSION['error']['Add_User'] = feedback_Submit($Upload->getError(), "erro");
        header("Location:../Add_User.php");
    }

}else{
    $_SESSION['error']['Add_User'] = feedback_Submit("Preencha todos os campos corretamente", "erro");
    header("Location:../Add_User.php");
}









function feedback_Submit($msg, $class){
    return "<div id='feedback_Submit' class='{$class}'>{$msg}</div>";
}
