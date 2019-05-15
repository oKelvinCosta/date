<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 13/01/2017
 * Time: 13:35
 */
require "../../_app/config.php";
$get = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);

$PagerMes = new Paginacao;

$PagerMes->setPagincao($get, 1, 'beforeMes', 'afterMes');

$mesSelect = new Select;
$mesSelect->exeSelect("meses", "LIMIT :limit OFFSET :offset", array( 'limit' => $PagerMes->getLimit(), 'offset'=> $PagerMes->getOffset()));

$PagerMes->dadosTabela("meses");
$mesResult = $mesSelect->getResultAssoc();

$_SESSION['mesCalendar'] = $mesResult['id_mes'];

echo $PagerMes->before();
?>
    <span><?= $mesResult['mes'];?></span>
<?= $PagerMes->after(); ?>