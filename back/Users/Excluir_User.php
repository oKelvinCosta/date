<?php
require_once "../../_app/config.php";

$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if (!empty($get)) {

    $Update = new Update;
    $Update->exeUpdate("usuarios", "desligado = :desligado", "WHERE id_user = :id", array('id' => $get['idUser'], 'desligado' => 1));
}

// Mostrar usuarios nao excluidos
$Select = new Select;
$Select->exeSelect("usuarios", "WHERE desligado != :des AND nome LIKE :like", array('des' => 1, 'like' => $get['text']));

require "../../Parts/Usuarios.php";