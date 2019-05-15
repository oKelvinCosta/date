<?php

$get = filter_input(INPUT_GET, "idCurso", FILTER_VALIDATE_INT);

require "../../_app/config.php";

$Select = new Select;
$Select->exeSelect("cursos", "WHERE id_curso = :id", array('id' => $get));

while ($Res = $Select->getResultAssoc()) {
    ?>
    <div class="edit highlight" id="modal_off_2">

        <div class="title clearfix">
            <span>ALTERAR <?= $Res['nome']; ?></span>
            <div>
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                }
                if (isset($_SESSION['sucess'])) {
                    echo $_SESSION['sucess'];
                }
                ?>
            </div>
        </div>
        <form action="#" id="MyFormEditarCurso" method="post" enctype="multipart/form-data" onsubmit="return false">
            <input type="hidden" name="id-curso" value="<?= $Res['id_curso']; ?>">
            <label class="label_m">
                <input type="text" placeholder="Curso: Técnico em Multimídia" name="curso" value="<?= $Res['nome']; ?>"
                       required>
                <span class="line"></span>
            </label>

            <label class="label_m">
                <select name="tipo" required>
                    <option value="">Selecione o Tipo de Curso</option>
                    <option value="1">Técnico</option>
                    <option value="2">Qualificação</option>
                    <option value="3">Aprendizagem</option>
                    <option value="4">Livre</option>
                </select>
            </label>

            <label class="label_m">
                <input type="text" placeholder="Data Início : dd-mm-aaaa" name="data_i"
                       value="<?= date("d-m-Y", strtotime($Res['data_inicio'])); ?>" required>
                <span class="line"></span>
            </label>

            <label class="label_m">
                <input id="data" type="text" placeholder="Data Término : dd-mm-aaaa" name="data_f"
                       value="<?= date("d-m-Y", strtotime($Res['data_final'])); ?>" required>
                <span class="line"></span>
            </label>

            <label class="label_m" for="show_semana">
                Dias Semanais
            </label>

            <!--SEMANA-->
            <input type="checkbox" hidden id="show_semana">
            <div class="semana box">
                <div>
                    <label for="domingo">Domingo</label>
                    <input type="checkbox" id="domingo" name="dias[]" value="0"> <br>
                </div>
                <div>
                    <label for="segunda">Segunda</label>
                    <input type="checkbox" name="dias[]" id="segunda" value="1"> <br>
                </div>
                <div>
                    <label for="terca">Terça</label>
                    <input type="checkbox" name="dias[]" id="terca" value="2"> <br>
                </div>
                <div>
                    <label for="quarta">Quarta</label>
                    <input type="checkbox" name="dias[]" id="quarta" value="3"> <br>
                </div>
                <div>
                    <label for="quinta">Quinta</label>
                    <input type="checkbox" name="dias[]" id="quinta" value="4"> <br>
                </div>
                <div>
                    <label for="sexta">Sexta</label>
                    <input type="checkbox" name="dias[]" id="sexta" value="5"> <br>
                </div>
                <div>
                    <label for="sabado">Sábado</label>
                    <input type="checkbox" name="dias[]" id="sabado" value="6"> <br>
                </div>
            </div>
            <!--FIM SEMANA-->

            <label class="label_m">
                <input type="text" placeholder="Carga Horária: 200H" name="carga_h" value="<?= $Res['carga_h']; ?>"
                       required>
                <span class="line"></span>
            </label>

            <label class="label_m">
                <input type="text" placeholder="Horário: 13H às 15H" name="horario" value="<?= $Res['horario']; ?>"
                       required>
                <span class="line"></span>
            </label>

            <label class="label_m label_textarea">
                <select name="prof" required>
                    <option value="">Selecione o Professor</option>

                    <?php
                    $Prefessores = new Select;

                    $Prefessores->fullSelect("SELECT id_user, U.nome AS Unome FROM cursos AS C INNER JOIN usuarios AS U  ON id_professor = id_user WHERE id_curso = :id", array('id' => $get));
                    $Selecionado = $Prefessores->getResultAssoc();

                    ?>
                    <option selected value="<?= $Selecionado['id_user']; ?>"><?= $Selecionado['Unome']; ?></option>
                    <?php

                    $Prefessores->exeSelect("usuarios", "WHERE desligado != :des", ['des' => 1]);

                    while ($prof = $Prefessores->getResultAssoc()) {
                        if ($prof['id_user'] != $Selecionado['id_user']) {

                            ?>
                            <option value="<?= $prof['id_user']; ?>"><?= $prof['nome']; ?></option>
                            <?php
                        }
                    }
                    ?>

                </select>
            </label>

            <label class="label_m">
                <input type="text" placeholder="Preço: R$ 200,00" name="preco" value="<?= $Res['preco']; ?>" required>
                <span class="line"></span>
            </label>

            <label class="label_m">
                <textarea placeholder="Descricção" name="desc" required>
                    <?= $Res['descricao']; ?>
                </textarea>
                <span class="line"></span>
            </label>

            <label id="labelPlano" class="plano" for="plano">
                Plano de Curso
                <input type="file" id="plano" name="plano">
            </label>

            <input class="label_m" type="submit" id="editar_curso" data-id_curso-type="<?= $Res['id_curso']; ?>">
        </form>
    </div>
    <?php
}