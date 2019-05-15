<?php

while ($C = $Cursos->getResultAssoc()) {


    if ($C['data_final'] < date("Y-m-d") AND $C['status'] != 3 AND $C['data_inicio'] < date("Y-m-d") AND $C['data_final'] != "0000-00-00" AND $C['data_inicio'] != "0000-00-00") {
        $terminadoBg = "terminadoBg";
        $terminadoColor = "terminadoColor";
    } else {
        $terminadoBg = null;
        $terminadoColor = null;
    }

    ?>
    <tr>
        <td data-curso_id-type="<?= $C['id_curso']; ?>">
            <a class="<?php if (isset($terminadoColor)) {
                echo $terminadoColor;
            } ?>" href="Uploads/Plano_de_Curso/<?= $C['plano']; ?>" download
               title="Download Plano de Curso"> <?= $C['nome']; ?> </a>
        </td>


        <?php
        if ($C['status'] == 1) {

            // Se curso terminou
            if($C['data_final'] < date("Y-m-d")){
                $qtd_gray = 'qtd_gray';
            }else{
                $qtd_gray = '';
            }

            ?>
            <td class="<?=$qtd_gray;?>">
                <?php
                if ($C['turma_cancelada'] == 1 OR $C['data_final'] < date("Y-m-d")) {
                    ?>
                    <a href="javascript:void(0)" class="add_alun_Desactive"></a>
                    <a href="javascript:void(0)" class="sub_alun_Desactive"></a>
                    <?php
                } else {
                    ?>
                    <a href="javascript:void(0)" class="add_alun" data-id="<?= $C['id_curso']; ?>"></a>
                    <a href="javascript:void(0)" class="sub_alun" data-id="<?= $C['id_curso']; ?>"></a>
                    <?php
                }
                ?>
                <span class="alun_atual" data-id="<?= $C['id_curso']; ?>">
                    <?php
                    if (empty($C['alun_matriculado'])) {
                        echo showColorAtual($C['alun_matriculado'], $C['qtd_min_alun']);

                    }else {
                        if ($C['alun_matriculado'] < 10) {
                            echo showColorAtual($C['alun_matriculado'], $C['qtd_min_alun']);
                        } else {
                            echo showColorAtual($C['alun_matriculado'], $C['qtd_min_alun']);
                        }
                    }
                    ?>
                </span>
                <span class="bar">|</span>

                <span class="min_alun">

            <?php
            if (empty($C['qtd_min_alun'])) {
                echo "00";
            } else if ($C['qtd_min_alun'] < 10) {
                echo "0" . $C['qtd_min_alun'];
            } else {
                echo $C['qtd_min_alun'];
            }
            ?>

        </span>
                <span class="bar">|</span>


                <span class="max_alun">
           <?php
           if (empty($C['qtd_max_alun'])) {
               echo "00";
           } else if ($C['qtd_max_alun'] < 10) {
               echo "0" . $C['qtd_max_alun'];
           } else {
               echo $C['qtd_max_alun'];
           }
           ?>
        </span>
            </td>
            <?php
        } else {
            echo "<td></td>";
        }
        ?>


        <?php
        // CATEGORIA

        switch ($C['tipo']) {
            case 1:
                ?>
                <td class='<?php if (isset($terminadoColor)) {
                    echo $terminadoColor;
                } ?>'>Técnico
                </td>
                <?php
                break;
            case 2:
                ?>
                <td class='<?php if (isset($terminadoColor)) {
                    echo $terminadoColor;
                } ?>'>Qualificação
                </td>
                <?php
                break;
            case 3:
                ?>
                <td class='<?php if (isset($terminadoColor)) {
                    echo $terminadoColor;
                } ?>'>Aprendizagem
                </td>
                <?php
                break;
            case 4:
                ?>
                <td class='<?php if (isset($terminadoColor)) {
                    echo $terminadoColor;
                } ?>'>Livre
                </td>
                <?php
                break;
            default:
                echo "<td></td>";
                break;
        }
        ?>
        <?php
        //STATUS

        switch ($C['status']) {
            case 1:
                ?>
                <td class='<?php if (isset($terminadoColor)) {
                    echo $terminadoColor;
                } ?>'>Aprovado
                </td>
                <?php
                break;
            case 2:
                ?>
                <td>Reprovado
                </td>
                <?php
                break;
            case 3:
                ?>
                <td class='<?php if (isset($terminadoColor)) {
                    echo $terminadoColor;
                } else {
                    echo "orange";
                } ?>'>Aguardando Aprovação
                </td>
                <?php
                break;
        }
        ?>

        <?php
        // ESTADO

        if ($C['status'] == 2) {
            ?>
            <td></td>
            <?php
        }elseif ($C['status'] == 3){
            ?>
            <td></td>
            <?php
        }  else if ($C['data_inicio'] == "0000-00-00" AND $C['data_final'] == "0000-00-00") {

            echo "<td></td>";

        } else if ($C['turma_cancelada'] == 1) {
            ?>
            <td class='<?php if (isset($terminadoColor)) {
                echo $terminadoColor;
            } else {
                echo "red";
            } ?>'>Cancelado
            </td>
            <?php
        } else if ($C['data_final'] >= date("Y-m-d") AND $C['data_inicio'] <= date("Y-m-d")) {
            ?>
            <td class='<?php if (isset($terminadoColor)) {
                echo $terminadoColor;
            } else {
                echo "blue";
            } ?>'>Andamento
            </td>
            <?php
        } else if ($C['data_final'] < date("Y-m-d")) {
            ?>
            <td class='<?php if (isset($terminadoColor)) {
                echo $terminadoColor;
            } ?>'>Terminado
            </td>
            <?php
        } else if ($C['data_inicio'] > date("Y-m-d") AND $C['status'] != 3) {
            ?>
            <td class='<?php if (isset($terminadoColor)) {
                echo $terminadoColor;
            } else {
                echo "green";
            } ?>'>A Iniciar
            </td>
            <?php
        } else {
            echo "<td></td>";
        }
        ?>



        <?php
        // GERENCIAMENTO


        // APROVADO
        if ($C['status'] == 1) {


            $classEditar = 'editar';
            $classAprovar = 'aprovar';
            $classReprovar = 'refutar';

            if ($C['turma_cancelada'] == 1) {
                $classReprovar = 'terminadoColor';

                if ($C['data_final'] == "0000-00-00" OR $C['data_final'] < date("Y-m-d")) {
                    $classAprovar = 'terminadoColor';
                }

                echo " <td><a href='#' class='" . $classEditar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"><span>Editar</span></a></td>";
                echo " <td><a href='#' class='" . $classAprovar . "' data-curso_id-type=\"" . $C['id_curso'] . "\" data-aprovacao='2'><span>Aprovar</span></a></td>";
                echo " <td><a href='#' class='" . $classReprovar . "' data-curso_id-type=\"" . $C['id_curso'] . "\" data-cancelamento='2'><span>Falta de Alunos</span></a></td>";
            }// Andamento
            else if ($C['data_final'] >= date("Y-m-d") AND $C['data_inicio'] <= date("Y-m-d")) {

                $classAprovar = 'terminadoColor';
                $classReprovar = 'terminadoColor';
                echo " <td><a href='#' class='" . $classEditar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"><span>Editar</span></a></td>";
                echo " <td><a href='#' class='" . $classAprovar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"><span>Aprovar</span></a></td>";
                echo " <td><a href='#' class='" . $classReprovar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"><span>Reprovar</span></a></td>";


                // Terminado
            } elseif ($C['data_final'] <= date("Y-m-d") AND $C['data_inicio'] <= date("Y-m-d") AND $C['data_final'] != "0000-00-00") {

                $classEditar = 'terminadoColor';
                $classAprovar = 'terminadoColor';
                $classReprovar = 'terminadoColor';
                echo " <td><a href='#' class='" . $classEditar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"><span>Editar</span></a></td>";
                echo " <td><a href='#' class='" . $classAprovar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"><span>Aprovar</span></a></td>";
                echo " <td><a href='#' class='" . $classReprovar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"'><span>Reprovar</span></a></td>";


                // A iniciar
            } elseif ($C['data_inicio'] >= date("Y-m-d")) {

                $classAprovar = 'terminadoColor';
                echo " <td><a href='#' class='" . $classEditar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"><span>Editar</span></a></td>";
                echo " <td><a href='#' class='" . $classAprovar . "' data-curso_id-type=\"" . $C['id_curso'] . "\" data-aprovacao='1'><span>Aprovar</span></a></td>";
                echo " <td><a href='#' class='" . $classReprovar . "' data-curso_id-type=\"" . $C['id_curso'] . "\" data-cancelamento='1'><span>Falta de Alunos</span></a></td>";

            } else {
                // Acabado de Aprovar
                $classAprovar = 'terminadoColor';


                echo " <td><a href='#' class='" . $classEditar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"><span>Editar</span></a></td>";
                echo " <td><a href='#' class='" . $classAprovar . "' data-curso_id-type=\"" . $C['id_curso'] . "\" data-aprovacao='1'><span>Aprovar</span></a></td>";
                echo " <td><a href='#' class='" . $classReprovar . "' data-curso_id-type=\"" . $C['id_curso'] . "\" data-cancelamento='1'><span>Falta de Alunos</span></a></td>";
            }


            // REPROVADO
        } else if ($C['status'] == 2) {

            $classEditar = 'editar';
            $classAprovar = 'terminadoColor';
            $classReprovar = 'terminadoColor';

            echo " <td><a href='#' class='" . $classEditar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"><span>Editar</span></a></td>";
            echo " <td><a href='#' class='" . $classAprovar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"><span>Aprovar</span></a></td>";
            echo " <td><a href='#' class='" . $classReprovar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"><span>Reprovar</span></a></td>";

            // AGUARDANDO APROVAÇÃO
        } elseif ($C['status'] == 3) {

            $classEditar = 'editar';
            $classAprovar = 'terminadoColor';
            $classReprovar = 'refutar';

            echo " <td><a href='#' class='" . $classEditar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"><span>Editar</span></a></td>";
            echo " <td><a href='#' class='" . $classAprovar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"><span>Aprovar</span></a></td>";
            echo " <td><a href='#' class='" . $classReprovar . "' data-curso_id-type=\"" . $C['id_curso'] . "\"><span>Reprovar</span></a></td>";


        }
        ?>

    </tr>
    <?php

}


function showColorAtual($Aluno_atual, $Qtd_min)
{

    // Muda a cor e coloca 0 se for menor que 10

    // red

    if ($Aluno_atual < $Qtd_min) {

        if ($Aluno_atual < 10) {
            $red = "<span style='color:  #ff2b41'>0" . $Aluno_atual . '</span>';
        } else {
            $red = "<span style='color:  #ff2b41'>" . $Aluno_atual . '</span>';
        }

        return $red;

    } elseif (empty($Aluno_atual)) {
        return "<span>0" . $Aluno_atual . '</span>';
    } else {
        // green
        if ($Aluno_atual < 10) {
            $green = "<span style='color:  #1dc462'>0" . $Aluno_atual . '</span>';
        } else {
            $green = "<span style='color:  #1dc462'>" . $Aluno_atual . '</span>';
        }

        return $green;
    }

}