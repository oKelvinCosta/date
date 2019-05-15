<?php

$post = filter_input(INPUT_POST, 'text', FILTER_DEFAULT);

require "../../_app/config.php";

// Mostrar usuarios nao excluidos
$Select = new Select;
$Select->exeSelect("usuarios", "WHERE desligado = :des AND nome LIKE :like", array('des' => 1, 'like' => $post));

require "../../Parts/Usuarios.php";