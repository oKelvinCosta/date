<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 23/01/2017
 * Time: 11:38
 */

require "../../_app/config.php";

$get = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);

$Pager = new Paginacao;
$Pager->setPagincao($get, 1, 'before', 'after');

$Ano = new Select;
$Ano->exeSelect("anos", "LIMIT :limit OFFSET :offset",array('limit'=> $Pager->getLimit(), 'offset'=> $Pager->getOffset()));

$Pager->dadosTabela("anos");

echo $Pager->before();

$Ano = $Ano->getResultAssoc();
$_SESSION['ano'] = $Ano['ano'];

echo "<span>".$Ano['ano']."</span>";

echo $Pager->after();
