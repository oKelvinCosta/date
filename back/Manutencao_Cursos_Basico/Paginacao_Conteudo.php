<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 23/01/2017
 * Time: 11:50
 */

require "../../_app/config.php";

$get = filter_input_array(INPUT_GET, FILTER_VALIDATE_INT);

// Pagina o ano, e no que mudar o ano usa ele para selecionar os cursos
$Pager = new Paginacao;
$Pager->setPagincao($get['page'], 1, 'before', 'after');
$Pager->dadosTabela("anos");

$Anos = new Select;
$Anos->exeSelect("anos", "LIMIT :limit OFFSET :offset", array('limit' => $Pager->getLimit(), 'offset' => $Pager->getOffset()));

$Ano = $Anos->getResultAssoc();
$_SESSION['ano'] = $Ano['ano'];

/*
 * Entre Datas
 *
 * data_inicio - dataPager - data_final

2017-10-01 < 2019-12-31 AND 2019-01-01 < 2019-05-01
2017-10-01 < 2018-12-31 AND 2018-01-01 < 2019-05-01
2017-10-01 < 2017-12-31 AND 2017-01-01 < 2019-05-01

*/

require "../../Parts/Manutencao_Cursos_Content_Basico.php";
?>
