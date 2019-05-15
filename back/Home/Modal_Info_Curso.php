<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 12/01/2017
 * Time: 13:32
 */
require "../../_app/config.php";
$get = filter_input_array(INPUT_GET, FILTER_VALIDATE_INT);


$Curso = new Select;
//$Curso->exeSelect("cursos", "WHERE id_curso = :id", ['id' => $get['idCurso']]);

$Curso->fullSelect("SELECT U.nome AS Unome, C.nome AS Cnome, carga_h, data_inicio, data_final, horario, descricao, plano, id_curso FROM cursos AS C
INNER JOIN usuarios AS U
ON C.id_professor = U.id_user
WHERE C.id_curso = :id
", array('id' => $get['idCurso']) );

while ($C = $Curso->getResultAssoc()){
    ?>


<div id="modal_off" class="info_curso">
    <div>
        <div class="layout clearfix">
            <div>
                <!--PAGE 1-->
                                     <span class="page1">

                                        <span class="db top">
                                            <span class="db nome"><?= $C['Cnome']?></span>
                                            <span class="db hora"><?= $C['carga_h']?></span>
                                            <span class="db sub">
                                                <span class="db"><?= date("d-m-Y", strtotime($C['data_inicio'])) ." a ". date("d-m-Y", strtotime($C['data_final']));?></span>
                                                <span class="db"><?= $C['horario']?></span>
                                                <span class="db"><?= $C['carga_h']?></span>
                                            </span>
                                        </span>

                                        <span class="db mid">
                                            <span class=""><?= $C['Unome']?></span>
                                            <span class="">Inscrições antes de <?=date("d-m-Y", strtotime($C['data_inicio']));?></span>
                                        </span>

                                        <span class="bot clearfix">
                                            <span class="db">PARA MAIS INFORMAÇÕES</span>
                                            <span class="email">CECOTEG@FIEMF.COM.BR</span>
                                            <span class="tel">3482-5635</span>
                                        </span>

                                     </span>
                <!--FIM PAGE 1-->
            </div>

            <div>
                <!--PAGE 2-->
                                    <span class="page2">

                                        <span class=" db dec">
                                            <p>
                                                <?= $C['descricao']?>
                                            </p>
                                        </span>

                                        <span class="db social">
                                            <span><img src="../../img/insta_w.png" alt="">/cecoteg</span>
                                            <span><img src="../../img/face_w.png" alt="">/facebook</span>
                                        </span>

                                        <span class="db logo">
                                            <img src="../../img/senai.jpg" alt="">
                                        </span>

                                    </span>
                <!--FIM PAGE 2-->
            </div>
        </div>

        <div class="info_options">
            <div>
                <b>STATUS:</b> Andamento
            </div>
            <div>
                <a href="
                <?php
                if(!empty($C['plano'])){
                    echo  "Uploads/Plano_de_Curso/".$C['plano'];
                }else{
                    echo "#";
                }
                ?>
                "
                >PLANO</a>
                <a href="#" id="alterar" data-id_curso-type="<?= $C['id_curso']?>">ALTERAR</a>
            </div>
        </div>

        <!--MODAL ALTERAR-->
        <!--FIM MODAL ALTERAR-->
    </div>
</div>


<?php
}
?>