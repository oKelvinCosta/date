<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 11/01/2017
 * Time: 14:02
 */

require "../../_app/config.php";

$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);

// Para permanacer a pesquisa depois de paginar o ano
$Ptext = $get['text'];
$Pcat = $get['cat'];
$Pestado = $get['estado'];


$Pager = new Paginacao;
$Pager->setPagincao($get['page'], 1, 'beforeH', 'afterH');

$Select = new Select;
$Select->exeSelect("anos", "LIMIT :limit OFFSET :offset", array("limit" => $Pager->getLimit(), "offset" => $Pager->getOffset()));
$Pager->dadosTabela("anos");

$Ano = $Select->getResultAssoc();
$_SESSION['ano'] = $Ano['ano'];


$Select->exeSelect("meses");

require "../../Parts/Home_Conteudo.php";


function multPesquisa($Contexto, $Ano, $Mes, $Dias, $Text = null, $Categoria = null, $Estado = null)
{

    $Termos = "WHERE data_inicio >= :data_inicio AND data_inicio <= :data_final AND status = :status";
    $Array = array('data_inicio' => $Ano . '-' . $Mes . '-01', 'data_final' => $Ano . '-' . $Mes . '-' . $Dias, 'status' => 1);

    if (!empty($Categoria)) {
        $Termos .= ' AND tipo = :tipo';
        $Array = array_merge($Array, array('tipo' => $Categoria));
    }

    if (!empty($Text)) {
        $Termos .= ' AND nome LIKE :like';
        $Array = array_merge($Array, array('like' => $Text));
    }

    switch ($Estado) {
        // A iniciar
        case 1:
            $Termos .= ' AND data_inicio >= :data_atual AND turma_cancelada != :cancelado';
            $Array = array_merge($Array, array('data_atual' => date("Y-m-d"), 'cancelado' => 1));
            break;
        // Andamentto
        case 2:
            $Termos .= ' AND data_final >= :data_atual AND data_inicio <= :data_atual AND turma_cancelada != :cancelado';
            $Array = array_merge($Array, array('data_atual' => date("Y-m-d"), 'cancelado' => 1));
            break;
        // Terminado
        case 3:
            $Termos .= ' AND data_final <= :data_atual';
            $Array = array_merge($Array, array('data_atual' => date("Y-m-d")));
            break;
        case 4:
            $Termos .= ' AND turma_cancelada = :cancelado';
            $Array = array_merge($Array, array('cancelado' => 1));
            break;
    }

    if ($Contexto == 1) {
        return $Array;
    } elseif ($Contexto == 2) {
        return $Termos;
    }

}
