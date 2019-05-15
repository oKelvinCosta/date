<?php

/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 13/01/2017
 * Time: 11:39
 */
class Data_Manipulacao
{
    
    private $IdMes;
    private $Data;
    private $DataAnoMes;
    private $SemanaArray = array( "Domingo", "Segunda-feira", "Terça-feita", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");
    private $DataDiaSemana;
    private $DataSemana;
    private $Dia;

    
    public function setData($i, $ResIdMes)
    {
        $this->IdMes = $ResIdMes;
        $this->Dia = $i;
        
        // Coloca 0 antes do número
        if ($this->IdMes < 10) {
            $mes = '0' . $this->IdMes;
        } else {
            $mes = $this->IdMes;
        }

        // Y-m-d
        $this->Data = $_SESSION['ano'] . '-' . $mes . '-' . $this->Dia;
        // Y-m
        $this->DataAnoMes = $_SESSION['ano'] . '-' . $mes;
        // Dia semana
        $this->DataDiaSemana = getdate(strtotime($this->Data ));
        $this->DataDiaSemana = $this->DataDiaSemana['wday'];
        // Nome do dia da semana
        $this->DataSemana = $this->SemanaArray[$this->DataDiaSemana];
    }

    /**
     * @return mixed
     */
    public function getIdMes()
    {
        return $this->IdMes;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->Data;
    }

    /**
     * @return mixed
     */
    public function getDataAnoMes()
    {
        return $this->DataAnoMes;
    }

    /**
     * @return array
     */
    public function getSemanaArray()
    {
        return $this->SemanaArray;
    }

    /**
     * @return mixed
     */
    public function getDataDiaSemana()
    {
        return $this->DataDiaSemana;
    }

    /**
     * @return mixed
     */
    public function getDataSemana()
    {
        return $this->DataSemana;
    }

    /**
     * @return mixed
     */
    public function getDia()
    {
        return $this->Dia;
    }
    
    

    
}