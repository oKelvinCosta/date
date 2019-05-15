<?php
require "../../_app/config.php";

$get = filter_input_array(INPUT_GET, FILTER_VALIDATE_INT);

$_SESSION['id_user_click'] = $get['idUser'];



$Select = new Select;
$Select->exeSelect("usuarios", "WHERE id_user = :id", array('id' => $get['idUser']));
$Res = $Select->getResultAssoc();
    ?>
<div class="add_user highlight" id="modal_off">
    <div class="container_form">
        <div class="title_form clearfix">
            <span>
                Editar
                <?php
                echo $Res['nome'];
                ?>
            </span>
        </div>


        <form action="back/Users/Update_Usuario.php" method="post" enctype="multipart/form-data" id="MyForm">

<!--            Status USer-->
            <input type="hidden" name="desligado" value="<?= $Res['desligado'];?>">

            <!--Nome-->
            <label class="label_material">
                <input class="campo" id="nome" type="text" name="nome" data-ordem="0" value="<?= $Res['nome'];?>" required>
                <span class="placeholder">Nome</span>
                <span class="line_bottom"></span>
                <span class="feedback"></span>
            </label>


            <!--Email-->
            <label class="label_material">
                <input class="campo mail" type="text" name="email" data-ordem="1" value="<?= $Res['email'];?>" required>
                <span class="placeholder">Email</span>
                <span class="line_bottom"></span>
                <span class="feedback"></span>
            </label>

            <!--Unidade-->
            <label class="label_material">
                <input class="campo" type="text" name="unidade" data-ordem="2" value="<?= $Res['unidade'];?>" required>
                <span class="placeholder">Unidade</span>
                <span class="line_bottom"></span>
                <span class="feedback"></span>
            </label>

            <!--Categoria-->
            <label class="label_material">
                <select class="campo" name="permicao" id="permicao" data-ordem="3" required>

                    <?php

                    switch ($Res['permicao']){
                        case '':
                        case 0:
                            $zero = "selected";
                        break;
                        case 1:
                            $one = "selected";
                            break;
                        case 2:
                            $two = "selected";
                            break;
                        case 3:
                            $trhee = "selected";
                            break;
                    }

                    ?>

                    <option value="" <?= @$zero;?>>Selecione a permição do usuário</option>
                    <option value="1" <?= @$one;?>>Administrador</option>
                    <option value="2" <?= @$two;?>>Professor</option>
                    <option value="3" <?= @$trhee;?>>Secretaria</option>
                </select>
                <span class="line_bottom"></span>
                <span class="feedback"></span>
            </label>

            <!--                    Data de Nascimento-->
            <label class="label_material data_input">
                <input class="campo" id="data_n" type="date" name="nascimento" data-ordem="4" value="<?= $Res['data_nasc'];?>" required>
                <span class="placeholder">Data de Nascimento</span>
                <span class="line_bottom"></span>
                <span class="feedback"></span>
            </label>

            <!--Formação-->
            <label class="label_material">
                <input class="campo" id="formacao" type="text" name="formacao" data-ordem="5" value="<?= $Res['formacao'];?>" required>
                <span class="placeholder">Formação</span>
                <span class="line_bottom"></span>
                <span class="feedback"></span>
            </label>

            <!--Foto-->
            <div class="material_file clearfix">
                <label style="width: auto" for="file" class="label_file">
                    <input class="campo" type="file" name="foto" id="file" data-ordem="6">
                    <i class="botao" id="btn_file">ENVIAR FOTO</i>
                </label>
                <div style="width: calc(100% - 130px);" class="label_material">
                    <input class="campo" id="name_file" type="text" data-ordem="7">
                    <span class="line_bottom"></span>
                    <span class="feedback"></span>

                    <span style="display: none" class="line_bottom"></span>
                    <span style="display: none" class="feedback"></span>
                </div>
            </div>

            <input class="botao" type="submit" id="updateUser" name="add_c" value="ALTERAR">
        </form>
    </div>
</div>