<?php

/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 11/01/2017
 * Time: 13:34
 */
class Paginacao
{
    private $Limit;
    private $Ofsset;
    private $Rows;
    private $NumPages;
    private $PageAtual;

    private $Tabela;
    private $Termos;
    private $Places;

    // Será o id da <
    private $Contexto;

    // Será o id da >
    private $Contexto2;

    // Seta informações primordiais
    public function setPagincao($PageAtual, $Limit, $Contexto, $Contexto2){
        $this->Limit = $Limit;
        $this->PageAtual = $PageAtual;
        $this->Offset = ($this->PageAtual * $this->Limit) - $this->Limit;
        $this->Contexto = $Contexto;
        $this->Contexto2 = $Contexto2;
    }

    // Pega informações da consulta
    public function dadosTabela($Tabela, $Termos = null, array $Places = null){
        $this->Tabela = $Tabela;
        $this->Termos = $Termos;
        $this->Places = $Places;

        $Read = new Select;
        $Read->exeSelect($this->Tabela, $this->Termos, $this->Places);
        $this->Rows = $Read->getRows();

        $this->calculos();
    }

    // Botao Before
    public function before(){
        $Before = $this->PageAtual - 1;
        if($Before > 0){
            return "<a href='javascript:void(0)' title='Paginação Ano Anterior' class='arrowLeft' id='".$this->Contexto."' datatype='".$Before."' ></a>";
        }else{
            return "<a href='javascript:void(0)' title='Paginação Ano Anterior' class='arrowLeft_off' ></a>";
        }
    }


    // Botao After
    public function after(){
        $After= $this->PageAtual + 1;
        if($After <= $this->NumPages){
            return "<a href='javascript:void(0)' title='Paginação Próximo Ano' class='arrowRight' id='".$this->Contexto2."' datatype='".$After."' ></a>";
        }else{
            return "<a href='javascript:void(0)' title='Paginação Próximo Ano' class='arrowRight_off' ></a>";
        }
    }
    
    
    public function getLimit(){
        return $this->Limit;
    }


    public function getOffset(){
        return $this->Offset;
    }
    
    
    private function calculos(){
        if($this->Rows > $this->Limit){
            $this->NumPages = ceil($this->Rows / $this->Limit);
        }
    }
}