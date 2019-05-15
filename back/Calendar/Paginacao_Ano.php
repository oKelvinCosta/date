<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 13/01/2017
 * Time: 13:35
 */
require "../../_app/config.php";
$get = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);

$PagerAno = new Paginacao;

$PagerAno->setPagincao($get, 1, 'before', 'after');

$anoSelect = new Select;
$anoSelect->exeSelect("anos", "LIMIT :limit OFFSET :offset", array( 'limit' => $PagerAno->getLimit(), 'offset'=> $PagerAno->getOffset()));

$PagerAno->dadosTabela("anos");
$anoResult = $anoSelect->getResultAssoc();

$_SESSION['ano'] = $anoResult['ano'];

echo $PagerAno->before();
?>
    <span><?= $anoResult['ano'];?></span>
<?= $PagerAno->after(); ?>