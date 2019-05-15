<?php

/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 09/01/2017
 * Time: 17:03
 */
class Select extends Conexao
{
    private $Tabela;
    private $Termos;
    private $Places;
    /** @var  PDOStatement */
    private $Query;
    /** @var  PDO */
    private $PDO;


    // Executa os outros métodos
    public function exeSelect($Tabela, $Termos = null, $Places = null)
    {
        $this->Tabela = $Tabela;
        $this->Termos = $Termos;
        $this->Places = $Places;
        $this->getSyntax();
        $this->Executor();

    }

    public function fullSelect($Query, $Places = null)
    {
        $this->Query = $Query;
        $this->Places = $Places;

        $this->Executor();
    }

    // Retorna linhas selecionadas
    public function getRows()
    {
        return $this->Query->rowCount();
    }

    // Associa as tabelas a serem mostradas
    public function getResultAssoc()
    {
        return $this->Query->fetch(PDO::FETCH_ASSOC);
    }

    // Associa as tabelas a serem mostradas
    public function getResultAll()
    {
        return $this->Query->fetchALL(PDO::FETCH_ASSOC);
    }


    // Cria a sintaxe
    private function getSyntax()
    {
        $this->Query = "SELECT * FROM {$this->Tabela} {$this->Termos}";
    }

    // Prepara a quey
    private function getCon()
    {
        $this->PDO = parent::getPDO();
        $this->Query = $this->PDO->prepare($this->Query);


        if ($this->Places) {
            foreach ($this->Places as $key => $value) {
                if ($key == 'limit' OR $key == 'offset') {
                    $value = (int)$value;
                    $this->Query->bindValue($key, $value, PDO::PARAM_INT);
                } else if($key == 'like' OR $key == 'like2' OR $key == 'like3' OR $key == 'like4'){
                    $this->Query->bindValue($key, "%".$value."%", PDO::PARAM_STR);

                }else {
                    $this->Query->bindValue($key, $value, PDO::PARAM_STR);
                }
            }
        }
    }

    // Executa a ação select
    private function Executor()
    {
        try {

            $this->getCon();
            $this->Query->execute();

        } catch (PDOException $e) {
            echo 'Select <br>';
            echo $e->getMessage() . '<br>';
            echo $e->getLine() . '<br>';
        }
    }
}