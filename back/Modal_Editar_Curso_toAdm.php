<?php

$get = filter_input(INPUT_GET, "idCurso", FILTER_VALIDATE_INT);
$identify = filter_input(INPUT_GET, "identify", FILTER_VALIDATE_INT);

require "../_app/config.php";

$Select = new Select;
$Select->exeSelect("cursos", "WHERE id_curso = :id", array('id' => $get));

while ($Res = $Select->getResultAssoc()) {
    ?>
    <div class="edit highlight" id="modal_off_2">

        <div class="container_form">
            <div class="title_form clearfix">
                <span>Aprovar / Editar</span>
            </div>

            <form action="back/Update_Curso_toAdm.php" method="post" id="MyFormEditarCurso" enctype="multipart/form-data">

                <input type="hidden" name="id-curso" value="<?= $Res['id_curso']; ?>">

                <!--CURSO-->
                <label class="label_material">
                    <input class="campo" id="curso" type="text" name="curso" data-ordem="0"
                           value="<?= $Res['nome']; ?>">
                    <span class="placeholder">Curso</span>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>

                <!--TIPO-->
                <label class="label_material">
                    <select class="campo" name="categoria" id="cat" data-ordem="1" >


                        <?php

                        $t1 = '';
                        $t2 = '';
                        $t3 = '';
                        $t4 = '';

                        if ($Res['tipo'] == 1) {
                            $t1 = "selected";
                        } else if ($Res['tipo'] == 2) {
                            $t2 = "selected";
                        } else if ($Res['tipo'] == 3) {
                            $t3 = "selected";
                        } else if ($Res['tipo'] == 4) {
                            $t4 = "selected";
                        }else if ($Res['tipo'] == 5) {
                            $t5 = "selected";
                        }else if ($Res['tipo'] == 6) {
                            $t6 = "selected";
                        }
                        ?>

                        <option value="">Categoria de curso</option>
                        <option <?= $t6; ?> value="6">Aperfeiçoamento</option>
                        <option <?= $t3; ?> value="3">Aprendizagem</option>
                        <option <?= $t5; ?> value="5">Iniciação</option>
                        <option <?= $t4; ?> value="4">Livre</option>
                        <option <?= $t2; ?> value="2">Qualificação</option>
                        <option <?= $t1; ?> value="1">Técnico</option>
                    </select>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>

                <!--DATA_INICIO-->
                <label class="label_material data_input">
                    <input class="campo" id="data_i" type="date" name="data_i" data-ordem="2" required
                           value="<?php if($Res['data_inicio']!= "0000-00-00"){echo $Res['data_inicio'];} ?>">
                    <span class="placeholder">Data de Inicio</span>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>

                <!--DATA_FINAL-->
                <label class="label_material data_input">
                    <input class="campo" id="data_f" type="date" name="data_f" data-ordem="3" required
                           value="<?php if($Res['data_final'] != "0000-00-00"){echo $Res['data_final'];} ?>">
                    <span class="placeholder">Data de Término</span>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>

                <!--carga_h-->
                <label class="label_material">
                    <input class="campo" type="text" name="carga_h" data-ordem="4" required
                           value="<?= $Res['carga_h']; ?>">
                    <span class="placeholder">Carga Horária: 200H</span>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>

                <!--TURNO-->
                <label class="label_material">
                    <select class="campo" name="turno" id="turno" data-ordem="5" required>

                        <?php

                        $tu1 = '';
                        $tu2 = '';
                        $tu3 = '';

                        if ($Res['turno'] == 1) {
                            $tu1 = "selected";
                        } else if ($Res['turno'] == 2) {
                            $tu2 = "selected";
                        } else if ($Res['turno'] == 3) {
                            $tu3 = "selected";
                        }

                        ?>


                        <option value="">Turno do curso</option>
                        <option <?= $tu1; ?> value="1">Manhã</option>
                        <option <?= $tu2; ?> value="2">Tarde</option>
                        <option <?= $tu3; ?> value="3">Noite</option>
                    </select>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>

                <!--HORARIO-->
                <label class="label_material">
                    <input class="campo" type="text" name="horario" data-ordem="6" required
                           value="<?= $Res['horario']; ?>">
                    <span class="placeholder">Horário: 00H às 00H</span>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>

                <!--PREÇO-->
                <label class="label_material">
                    <input class="campo" id="preco" type="text" name="preco" data-ordem="7" required
                           value="<?= $Res['preco']; ?>">
                    <span class="placeholder">Preço: R$: 000,00</span>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>

                <!--QTD MIN ALUNOS-->
                <label class="label_material">
                    <input class="campo" type="number" name="alun_min" data-ordem="8" value="<?= $Res['qtd_min_alun']; ?>" required>
                    <span class="placeholder">Qtd. mínimo alunos</span>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>

                <!--QTD MAX ALUNOS-->
                <label class="label_material">
                    <input class="campo" type="number" name="alun_max" data-ordem="9" value="<?= $Res['qtd_max_alun']; ?>" required>
                    <span class="placeholder">Qtd. máximo alunos</span>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>

                <!--PROF-->
                <label class="label_material">
                    <select class="campo" name="prof" id="prof" data-ordem="10" required>
                        <option value="">Professores</option>

                        <?php

                        $Prefessores = new Select;

                        $Prefessores->fullSelect("SELECT id_user, U.nome AS Unome FROM cursos AS C INNER JOIN usuarios AS U  ON id_professor = id_user WHERE id_curso = :id ", array('id' => $get));
                        $Selecionado = $Prefessores->getResultAssoc();

                        ?>
                        <option selected value="<?= $Selecionado['id_user']; ?>"><?= $Selecionado['Unome']; ?></option>
                        <?php

                        $Prefessores->exeSelect("usuarios", "WHERE desligado != :des", array('des' => 1));

                        while ($prof = $Prefessores->getResultAssoc()) {
                            if ($prof['id_user'] != $Selecionado['id_user'] AND $prof['desligado'] != 1) {

                                ?>
                                <option value="<?= $prof['id_user']; ?>"><?= $prof['nome']; ?></option>
                                <?php
                            }
                        }
                        ?>

                    </select>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>

                <!--                Dias Semanais-->
                <div class="label_material conteiner_check ">
                    <div>Dias Semanais</div>
                    <span id="feedback_check"></span>
                    <div class="group_check">

                        <?php
                        //echo $Res['id_dias'];

                        $d = array();
                        for ($i = 0; $i < strlen($Res['id_dias']); $i++) {
                            $d[$i] = substr($Res['id_dias'], $i, 1);
                        }




                        ?>


                        <label for="domingo">
                            <input type="checkbox" id="domingo" name="dias[]" value="0"
                                <?php

                                $w = 0;
                                while ($w < count($d)) {
                                    if ($d[$w] == 0) {
                                        echo "checked";
                                    }
                                    $w++;
                                }

                                ?>
                            >
                            <i></i>
                            Domingo
                        </label>
                        <label for="segunda">
                            <input type="checkbox" id="segunda" name="dias[]" value="1"
                                <?php

                                $w = 0;
                                while ($w < count($d)) {
                                    if ($d[$w] == 1) {
                                        echo "checked";
                                    }
                                    $w++;
                                }

                                ?>
                            >
                            <i></i>
                            Segunda-feira
                        </label>
                        <label for="terca">
                            <input type="checkbox" id="terca" name="dias[]" value="2"
                                <?php

                                $w = 0;
                                while ($w < count($d)) {
                                    if ($d[$w] == 2) {
                                        echo "checked";
                                    }
                                    $w++;
                                }

                                ?>
                            >
                            <i></i>
                            Terça-feira
                        </label>
                        <label for="quarta">
                            <input type="checkbox" id="quarta" name="dias[]" value="3"
                                <?php

                                $w = 0;
                                while ($w < count($d)) {
                                    if ($d[$w] == 3) {
                                        echo "checked";
                                    }
                                    $w++;
                                }

                                ?>
                            >
                            <i></i>
                            Quarta-feira
                        </label>
                        <label for="quinta">
                            <input type="checkbox" id="quinta" name="dias[]" value="4"
                                <?php

                                $w = 0;
                                while ($w < count($d)) {
                                    if ($d[$w] == 4) {
                                        echo "checked";
                                    }
                                    $w++;
                                }

                                ?>
                            >
                            <i></i>
                            Quinta-feira
                        </label>
                        <label for="sexta">
                            <input type="checkbox" id="sexta" name="dias[]" value="5"
                                <?php

                                $w = 0;
                                while ($w < count($d)) {
                                    if ($d[$w] == 5) {
                                        echo "checked";
                                    }
                                    $w++;
                                }

                                ?>
                            >
                            <i></i>
                            Sexta-feira
                        </label>
                        <label for="sabado">
                            <input type="checkbox" id="sabado" name="dias[]" value="6"
                                <?php

                                $w = 0;
                                while ($w < count($d)) {
                                    if ($d[$w] == 6) {
                                        echo "checked";
                                    }
                                    $w++;
                                }

                                ?>
                            >
                            <i></i>
                            Sábado
                        </label>
                    </div>
                </div>


                <!--PLANO-->

                <?php
                if($Res['plano']){
                    $existsPlano = 1;
                    $planoClass = 'existFileBg';
                    $existsPlanoLine ='style="width:100%; height:2px; background-color:#00a500"';
                    $existsPlanoBtn ='style="background-color:#00a500"';
                }else{
                    $existsPlano = 2;
                    $planoClass = 'notExistFileBg';
                    $existsPlanoLine ='style="width:100%; height:2px; background-color:#ff2b41"';
                    $existsPlanoBtn ='style="background-color:#ff2b41"';
                }
                ?>

                <div class="material_file clearfix">
                    <label for="file" class="label_file">
                        <input class="campo" type="file" name="plano" id="file" data-ordem="11"  data-exists="<?= $existsPlano;?>">
                        <i <?= $existsPlanoBtn;?> class="botao" id="btn_file">ENVIAR PLANO DE CURSO</i>
                    </label>
                    <div class="label_material">
                        <input class="campo" id="name_file" type="text" data-ordem="12" >
                        <span <?= $existsPlanoLine;?> class="line_bottom"></span>
                        <span class="feedback"></span>

                        <span style="display: none" class="line_bottom"></span>
                        <span style="display: none" class="feedback"></span>
                    </div>
                </div>



                <!--CAPA-->

                <?php
                if($Res['capa']){
                    $capaClass = 'existFileBg';
                }else{
                    $capaClass = 'notExistFileBg';
                }
                ?>

                <div class="material_file clearfix">

                    <div class="label_material legend">
                        <span class="placeholder">Tamanho mínimo: 1000 x 400</span>
                    </div>

                    <label for="capa" class="label_file">
                        <input class="campo" type="file" name="capa" id="capa" data-ordem="13" >
                        <i class="botao <?= $capaClass;?>" id="btn_capa">ENVIAR IMAGEM DE CAPA</i>
                    </label>
                    <div class="label_material">
                        <input class="campo" id="name_capa" type="text" data-ordem="14" >
                        <span class="line_bottom <?= $capaClass;?>"></span>
                        <span class="feedback"></span>

                        <span style="display: none" class="line_bottom"></span>
                        <span style="display: none" class="feedback"></span>
                    </div>
                </div>


                <!--DESCRICAO-->
                <label class="label_material">
                    <textarea class="campo" id="desc" name="desc" data-ordem="15" >
                        <?= $Res['descricao']; ?>
                    </textarea>
                    <span class="placeholder">Descricção</span>
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>
                </label>


                <input class="botao" type="submit" id="submit"  value="ATUALIZAR / APROVAR">

                <?php
                if(!empty($identify)){
                    ?>
                    <input class="botao" type="submit" data-id_curso="<?= $Res['id_curso'];?>" id="submit_refutar" value="REPROVAR">
                    <?php
                }
                ?>

            </form>
        </div>
    </div>
    <?php
}



