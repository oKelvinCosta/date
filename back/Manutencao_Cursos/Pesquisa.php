<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 21/01/2017
 * Time: 16:47
 */


require "../../_app/config.php";
$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

?>


        <?php
        $Cursos = new Select;

        // Select com pesquisa AJAX
        $Cursos->exeSelect("cursos",
            multPesquisa(2, $_SESSION['ano'], $post['text'], $post['categoria'], $post['status'], $post['estado']),
            multPesquisa(1, $_SESSION['ano'], $post['text'], $post['categoria'], $post['status'], $post['estado']));


require "../../Parts/Manutencao_Cursos_Content_While.php";



function multPesquisa($Contexto, $Ano, $Text, $Categoria = null, $Status = null, $Estado = null)
{

    $Termos = "WHERE  ((data_inicio <= :data_inicio AND data_final >= :data_final) OR (data_final = :zero)) AND nome LIKE :like";
    $Array = array("data_inicio" => $Ano . '-12-12', 'data_final'=> $Ano.'-01-01', 'like' => $Text, 'zero' => "0000-00-00");

    if (!empty($Status)) {

        // Data não definida ainda*

            $Termos .= ' AND status = :status';
            $Array = array_merge($Array, array('status' => $Status));

    }

    if (!empty($Categoria)) {



            $Termos .= ' AND tipo LIKE :like2';
            $Array = array_merge($Array, array('like2' => $Categoria));



    }





    switch ($Estado) {
        case 1:
            $Termos .= ' AND data_final >= :data_atual AND data_inicio <= :data_atual AND turma_cancelada != :cancelado AND data_inicio != :zero AND data_final != :zero';
            $Array = array_merge($Array, array('data_atual' => date("Y-m-d"), 'cancelado' => 1));
            break;
        case 2:
            $Termos .= ' AND data_final <= :data_atual AND turma_cancelada != :cancelado AND data_inicio != :zero AND data_final != :zero';
            $Array = array_merge($Array, array('data_atual' => date("Y-m-d"), 'cancelado' => 1));
            break;
        case 3:
            $Termos .= ' AND data_inicio >= :data_atual AND turma_cancelada != :cancelado AND data_inicio != :zero AND data_final != :zero';
            $Array = array_merge($Array, array('data_atual' => date("Y-m-d"), 'cancelado' => 1));
            break;
        case 4:
            $Termos .= ' AND turma_cancelada = :cancelado AND data_inicio != :zero AND data_final != :zero';
            $Array = array_merge($Array, array('cancelado' => 1));
            break;
    }

    $Termos .= '  ORDER BY nome, data_inicio, status';

    if ($Contexto == 1) {
        return $Array;
    } elseif ($Contexto == 2) {
        return $Termos;
    }

}