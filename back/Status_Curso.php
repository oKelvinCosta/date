<?php
require "../_app/config.php";
$get = filter_input_array(INPUT_GET, FILTER_VALIDATE_INT);


// Faz um update para aprovar ou reprovar

$UpdateC = new Update;
$UpdateC->exeUpdate("cursos", "status = :status", "WHERE id_curso = :id", array('id' => $get['idCurso'], 'status' => $get['status']));


if (isset($get['tipoCancelamento']) AND $get['tipoCancelamento'] == 1 AND $get['status'] == 2) {
    $UpdateC->exeUpdate("cursos", "turma_cancelada = :cancelada, status = :status", "WHERE id_curso = :id", array('id' => $get['idCurso'], 'cancelada' => $get['tipoCancelamento'], 'status' => 1));
}

if (isset($get['tipoAprovacao']) AND $get['tipoAprovacao'] == 2 AND $get['status'] == 1) {
    $UpdateC->exeUpdate("cursos", "turma_cancelada = :cancelada, status = :status", "WHERE id_curso = :id", array('id' => $get['idCurso'], 'cancelada' => 0, 'status' => 1));
}


// Conteudo Manutenção

require "../Parts/Manutencao_Cursos_Content.php";