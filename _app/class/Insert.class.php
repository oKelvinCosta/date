<?php

/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 09/01/2017
 * Time: 16:45
 */
class Insert extends Conexao
{
    private $Tabela;
    private $Places;
    /** @var  PDOStatement */
    private $Query;
    /** @var  PDO */
    private $PDO;


    public function exeInsert($Tabela, array $Places)
    {

        $this->Tabela = $Tabela;
        $this->Places = $Places;

        $this->getSyntax();
        $this->Executor();

    }
    
    // Retorna último id inserido
    public function getLastId(){
        return $this->PDO->lastInsertId();
    }
    
    

    // Prepara a sintaxe
    private function getSyntax(){

        $Key = implode(', ', array_keys($this->Places));
        $Value = ':'.implode(', :', array_keys($this->Places));


        $this->Query = "INSERT INTO {$this->Tabela} ({$Key}) VALUES ({$Value})";
    }

    // Prepara a query
    private function getCon(){
        $this->PDO = parent::getPDO();
        $this->Query = $this->PDO->prepare($this->Query);
    }

    // Executa a ação
    private function Executor(){
        try{
            $this->getCon();
            $this->Query->execute($this->Places);

        }catch (PDOException $e){
            echo 'Insert <br>';
           echo $e->getMessage().'<br>';
           echo $e->getPrevious().'<br>';
           echo $e->getLine().'<br>';
        }
    }

}