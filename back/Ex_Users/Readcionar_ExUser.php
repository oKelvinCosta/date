<?php
require_once "../../_app/config.php";


$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if (!empty($get['idUser'])) {

    $Update = new Update;
    $Update->exeUpdate("usuarios", "desligado = :desligado", "WHERE id_user = :id", array('id' => $get['idUser'], 'desligado' => 0));
}

// Mostrar usuarios excluidos
$Select = new Select;
$Select->exeSelect("usuarios", "WHERE desligado = :des AND nome like :like", array('des' => 1, 'like' => $get['text']));

require "../../Parts/Usuarios.php";