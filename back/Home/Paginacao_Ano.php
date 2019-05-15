<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 11/01/2017
 * Time: 14:02
 */

require "../../_app/config.php";

$get = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);

$Pager = new Paginacao;
$Pager->setPagincao($get, 1, 'beforeH', 'afterH');

$Select = new Select;
$Select->exeSelect("anos","LIMIT :limit OFFSET :offset", array("limit" => $Pager->getLimit(), "offset" => $Pager->getOffset()));
$Pager->dadosTabela("anos");

echo $Pager->before();
while($Ano = $Select->getResultAssoc()){
    $_SESSION['ano'] = $Ano['ano'];
    ?>
<span><?= $Ano['ano'];?></span>
<?php
}
echo $Pager->after();

