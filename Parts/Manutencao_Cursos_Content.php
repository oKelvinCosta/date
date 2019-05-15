<?php


$Cursos = new Select;

//$Cursos->exeSelect("cursos",
//    "WHERE (data_inicio <= :data_inicio AND data_final >= :data_final) OR (data_inicio = :dzero) OR (data_final = :dzero) OR (status = :statusAguarde) OR (status = :satusReprovado) ORDER BY data_inicio, status",
//    array("data_inicio" => $_SESSION['ano'] . '-12-12', 'data_final' => $_SESSION['ano'] . '-01-01', 'dzero' => "0000-00-00", 'statusAguarde' => 3, 'satusReprovado' => 2));

$Cursos->exeSelect("cursos",
"WHERE (data_inicio <= :data_inicio AND data_final >= :data_final)  OR (status = :statusAguarde) OR (status = :satusReprovado) ORDER BY nome, data_inicio, status",
    array("data_inicio" => $_SESSION['ano'] . '-12-12', 'data_final' => $_SESSION['ano'] . '-01-01',  'statusAguarde' => 3, 'satusReprovado' => 2));




// Att nos AJAXES
    require "Manutencao_Cursos_Content_While.php";


?>