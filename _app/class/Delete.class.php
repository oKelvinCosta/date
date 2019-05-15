<?php

/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 09/01/2017
 * Time: 17:22
 */
class Delete extends Conexao
{
    private $Tabela;
    private $Termos;
    private $Places;
    /** @var  PDOStatement */
    private $Query;
    /** @var  PDO */
    private $PDO;


    // Executa os métodos
    public function exeDelete($Tabela, $Termos, $Places){
        $this->Tabela = $Tabela;
        $this->Termos = $Termos;
        $this->Places = $Places;

        $this->getSyntax();
        $this->Executor();
    }

    // Escreve a sintaxe
    private function getSyntax(){
        $this->Query = "DELETE FROM {$this->Tabela} {$this->Termos}";
    }

    // Prepara a  query
    private function getCon(){
        $this->PDO = parent::getPDO();
        $this->Query= $this->PDO->prepare($this->Query);
    }

    // Executa o delete
    private function Executor(){
        try{
            $this->getCon();
            $this->Query->execute($this->Places);
        }catch (PDOException $e){
            echo 'Delete <br>';
            echo $e->getMessage()."<br>";
            echo $e->getLine();
        }
    }

}