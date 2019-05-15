<?php

// ###########################################
// ###########################################
// ###########################################
//ACHO QUE NAO ESTÁ EM USO
// ###########################################
// ###########################################
// ###########################################


/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 10/01/2017
 * Time: 19:27
 */

require "../../_app/config.php";
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);


if (!empty($form['curso']) AND !empty($form['dias']) AND
    !empty($form['data_i']) AND !empty($form['data_f']) AND !empty($form['horario']) AND
    !empty($form['carga_h']) AND !empty($form['prof']) AND !empty($form['preco']) AND !empty($form['tipo']) AND
    !empty($form['desc']) AND !empty($form['id-curso'])
) {
    // Se tiver PLANO novO
    if (!empty($_FILES['plano']['name'])) {

        // Deletar plano antigo
        $Select = new Select;
        $Select->exeSelect("cursos", "WHERE id_curso = :id", array('id' => $form['id-curso']));

        $Plano = $Select->getResultAssoc();
        $Plano = $Plano['plano'];

        unlink("../../Uploads/Plano_de_Curso/" . $Plano);
        // --

        $Upload = new Upload;
        $Upload->setFile($_FILES['plano'], 20);

        // Verificação de arquivo
        if ($Upload->getGo() == 3) {

            // Prepara algumas informações
            $dias = implode('', $form['dias']);

            $data_i = date("Y-m-d", strtotime($form['data_i']));
            $data_f = date("Y-m-d", strtotime($form['data_f']));


            // Update no banco
            $Update = new Update;
            $Update->exeUpdate("cursos",
                "
                id_professor = :id_professor,
                id_dias = :id_dias,
                nome = :nome,
                horario = :horario,
                descricao = :descricao,
                data_inicio = :data_inicio,
                data_final = :data_final,
                carga_h = :carga_h,
                preco = :preco,
                tipo = :tipo,
                plano = :plano
                ",
                "WHERE id_curso = :id",
                array(
                    'id' => $form['id-curso'],
                    'id_professor' => $form['prof'],
                    'id_dias' => $dias,
                    'nome' => $form['curso'],
                    'horario' => $form['horario'],
                    'descricao' => $form['desc'],
                    'data_inicio' => $data_i,
                    'data_final' => $data_f,
                    'carga_h' => $form['carga_h'],
                    'preco' => $form['preco'],
                    'tipo' => $form['tipo'],
                    'plano' => $Upload->getName()
                )
            );


            if ($Update->getLastId()) {
                $_SESSION['sucess'] = "Curso atualizado com sucesso!";
            } else {
                $_SESSION['error'] = "Tente novamente, o curso não foi atualizado.";
            }

        } else {
            $_SESSION['error'] = $Upload->getError();

        }

    } else {
        // Se nao tiver plano novo


        // Prepara algumas informações
        $dias = implode('', $form['dias']);

        $data_i = date("Y-m-d", strtotime($form['data_i']));
        $data_f = date("Y-m-d", strtotime($form['data_f']));

// Update no banco
        $Update = new Update;
        $Update->exeUpdate("cursos",
            "id_professor = :id_professor,
                id_dias = :id_dias,
                nome = :nome,
                horario = :horario,
                descricao = :descricao,
                data_inicio = :data_inicio,
                data_final = :data_final,
                carga_h = :carga_h,
                preco = :preco,
                tipo = :tipo
                ",
            "WHERE id_curso = :id",
            array(
                'id' => $form['id-curso'],
                'id_professor' => $form['prof'],
                'id_dias' => $dias,
                'nome' => $form['curso'],
                'horario' => $form['horario'],
                'descricao' => $form['desc'],
                'data_inicio' => $data_i,
                'data_final' => $data_f,
                'carga_h' => $form['carga_h'],
                'preco' => $form['preco'],
                'tipo' => $form['tipo']
            )
        );


        if ($Update->getLastId()) {
            $_SESSION['sucess'] = "Curso atualizado com sucesso!";
        } else {
            $_SESSION['error'] = "Tente novamente, o curso não foi atualizado. 2";
        }
    }


} else {
    $_SESSION['error'] = "Preencha todos os campos corretamente.";
}

        $Select = new Select;
        $Select->exeSelect("meses");

        while ($Res = $Select->getResultAssoc()) {
            ?>

            <div class="square box">
                <header class="clearfix">
                    <h2><?= $Res['mes']; ?></h2>
                    <a href="Calendar.php?mes=<?= $Res['id_mes']; ?>"><img src="img/calendar%20(1).png" alt=""></a>
                </header>

                <ul>

                    <?php

                    $Cursos = new Select;
                    $Cursos->exeSelect("cursos", "WHERE data_inicio > :ano LIMIT :limit", array('ano' => $_SESSION['ano'], 'limit' => 7));

                    // Coloca 0 antes do número
                    if ($Res['id_mes'] < 10) {
                        $mes = '0' . $Res['id_mes'];
                    } else {
                        $mes = $Res['id_mes'];
                    }

                    // Data Y-m
                    $data = $_SESSION['ano'] . '-' . $mes;

                    $i = 0;
                    while ($C = $Cursos->getResultAssoc()) {

                        // Só mostra o curso no mês em qeue ele se inicia
                        if (date("Y-m", strtotime($C['data_inicio'])) == $data) {
                            ?>
                            <li>
                                <span class="nomeCurso"
                                      data-curso_id-type="<?= $C['id_curso']; ?>" ><?= $C['nome']; ?></span>
                                <a href=""><img src="img/calendar.png" alt=""></a>
                            </li>
                            <?php
                            $i++;
                        }
                    }

                    ?>
                </ul>
                <?php
                if ($i == 6) {
                    ?>
                    <div class="seta" data-mes_id-type="<?= $Res['id_mes']; ?>"><img src="img/baixo.png" alt=""></div>
                    <?php
                }
                ?>
            </div>

            <?php
        }
        ?>