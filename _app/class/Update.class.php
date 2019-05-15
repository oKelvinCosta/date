<?php

/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 09/01/2017
 * Time: 17:42
 */
class Update extends Conexao
{
    private $Tabela;
    private $Termos;
    private $Dados;
    private $Places;
    /** @var  PDOStatement */
    private $Query;
    /** @var  PDO */
    private $PDO;


    public function exeUpdate($Tabela, $Dados, $Termos, array $Places)
    {
        $this->Tabela = $Tabela;
        $this->Termos = $Termos;
        $this->Dados = $Dados;
        $this->Places = $Places;

        $this->getSyntax();
        $this->Executor();
    }

    public function getLastId(){
        return $this->PDO->lastInsertId();
    }
    
    public function getRows(){
        return $this->Query->rowCount();
    }

    private function getSyntax()
    {
        $this->Query = "UPDATE {$this->Tabela} SET {$this->Dados} {$this->Termos}";
    }


    private function getCon()
    {
        $this->PDO = parent::getPDO();
        $this->Query = $this->PDO->prepare($this->Query);
    }


    private function Executor()
    {
        try {

            $this->getCon();
            $this->Query->execute($this->Places);

        } catch (PDOException $e) {
            echo 'Update <br>';
            echo $e->getMessage() . "<br>";
            echo $e->getLine();
        }
    }
}