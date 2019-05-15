<?php

// Listar cursos aprovados
// A iniciar
// Andamento
// Cancelado
// Terminado

$Cursos = new Select;
$Cursos->exeSelect("cursos",
"WHERE (data_inicio <= :data_inicio AND data_final >= :data_final) AND status = :aprovis ORDER BY nome, data_inicio, status",
    array("data_inicio" => $_SESSION['ano'] . '-12-12', 'data_final' => $_SESSION['ano'] . '-01-01', 'aprovis' => 1));




// Att nos AJAXES

    require "Manutencao_Cursos_Content_While_Basico.php";


?>