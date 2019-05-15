<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 12/01/2017
 * Time: 10:45
 */
require "../../_app/config.php";
$get = filter_input_array(INPUT_GET, FILTER_VALIDATE_INT);
?>

<div id="modal_off" class="highlight" for="seta_1">
    <div class="modal_seta box">
        <div class="cabecalho clearfix">
            <h3>2016</h3>
            <h4>Janeiro</h4>
            <a href=""><img src="../../img/calendar%20(1).png" alt=""></a>
        </div>
        <ul class="options">

            <?php

            if($get['idMes'] < 10){
                $mes = "0".$get['idMes'];
            }else{
                $mes = $get['idMes'];
            }

            $Mes = new Select;
            $Mes->exeSelect("meses", "WHERE id_mes = :id", array("id" => $mes));

            while($M = $Mes->getResultAssoc()){

                $CursosS = new Select;
                // Para não selecionar tantos cursos
                // Pega todos os cursos a partir daquele mes
                $CursosS->exeSelect("cursos", "WHERE data_inicio > :data",array('data' => $_SESSION['ano']."-".$mes));



                // Filtrar apenas os cursos que começam naquele mes
                while($C = $CursosS->getResultAssoc()){

                    if( date("Y-m", strtotime($C['data_inicio'])) == $_SESSION['ano']."-".$mes ){
                        ?>
                        <li>
                            <span class="nomeCurso"
                                  data-curso_id-type="<?= $C['id_curso']; ?>" ><?= $C['nome']; ?></span>
                            <a href="#"><img src="../../img/calendar.png" alt="clendario" title="calendario"></a>
                        </li>
                        <?php
                    }
                }
            }
            ?>




        </ul>
    </div>
</div>