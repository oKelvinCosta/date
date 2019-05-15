<?php

/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 09/01/2017
 * Time: 19:39
 */
class Login
{

    private $Email;
    private $Senha;
    private $Go = 1;
    private $Error;

    // Executa os métodos
    public function exeLogin($Email, $Senha)
    {
        if ($this->validate($Email, $Senha)) {

            $this->Email = $Email;
            $this->Senha = md5($Senha);

            $this->verifExist();

        } else {
            $this->Go = 2;
            $this->Error = 'Escreva o email e a senha corretamente.';
        }


    }


    // Retorna parametro de erro/sucesso
    public function getGo()
    {
        return $this->Go;
    }


    // Retorna erro
    public function getError()
    {
        return $this->Error;
    }


    // Valida
    private function validate($Email, $Senha)
    {
        if (filter_var($Email, FILTER_VALIDATE_EMAIL) AND filter_var($Senha, FILTER_DEFAULT)) {
            return true;
        } else {
            return false;
        }
    }


    // Verifica se usuario esta cadastrado
    private function verifExist()
    {
        $Select = new Select;
        $Select->exeSelect('usuarios', 'WHERE email = :email AND senha = :senha AND desligado != :desligado', array('email' => $this->Email, 'senha' => $this->Senha, 'desligado' => 1));

        if ($Select->getRows() == 1) {

            $this->Go = 3;

            // Para setar a session
            while ($Result = $Select->getResultAssoc()) {
                $_SESSION['user']['nome'] = $Result['nome'];
                $_SESSION['user']['id'] = $Result['id_user'];
                $_SESSION['user']['email'] = $Result['email'];
                $_SESSION['user']['permicao'] = $Result['permicao'];
                $_SESSION['user']['foto'] = $Result['foto'];
            }

            header("Location:../Home.php");

        } else {
            $this->Go = 2;
            $this->Error = 'O usuário não está cadastrado.';
        }
    }



}