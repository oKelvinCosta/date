<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 10/01/2017
 * Time: 19:27
 */

require "../../_app/config.php";
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$_SESSION['error'] = array();

// Adm
if (!empty($form['alun_min']) AND isset($form['alun_min'])) {

    if (
        !empty($form['curso']) AND
        !empty($form['categoria']) AND
        !empty($form['data_i']) AND
        !empty($form['data_f']) AND
        !empty($form['carga_h']) AND
        !empty($form['turno']) AND
        !empty($form['horario']) AND
        !empty($form['preco']) AND
        !empty($form['dias']) AND
        !empty($form['desc']) AND
        !empty($form['alun_min']) AND
        !empty($form['alun_max']) AND
        !empty($_FILES['capa']['name'])
    ) {

        $Capa = new Upload;
        $Capa->setImage($_FILES['capa'], 5, "Capas", null, 1);


        if( !empty($_FILES['plano']['name']) ){

            $Upload = new Upload;

            $Upload->setFile($_FILES['plano'], 20);

            if ($Upload->getGo() == 3 AND $Capa->getGo() == 3) {

                $dias = implode('', $form['dias']);

                $Insert = new Insert;
                $Insert->exeInsert("cursos", array(
                        'id_professor' => $_SESSION['user']['id'],
                        'nome' => $form['curso'],
                        'tipo' => $form['categoria'],
                        'data_inicio' => $form['data_i'],
                        'data_final' => $form['data_f'],
                        'carga_h' => $form['carga_h'],
                        'turno' => $form['turno'],
                        'horario' => $form['horario'],
                        'preco' => $form['preco'],
                        'id_dias' => $dias,
                        'descricao' => $form['desc'],
                        'status' => 1,
                        'plano' => $Upload->getName(),
                        'capa' => $Capa->getName(),
                        'qtd_min_alun' => $form['alun_min'],
                        'qtd_max_alun' => $form['alun_max']
                        )
                );

                if ($Insert->getLastId()) {
                    if($_SESSION['user']['permicao'] == 1){
                        $_SESSION['error']['Add_Curso'] = feedback_Submit("Curso cadastrado com sucesso", "success");
                        header("Location:../../Add_CursoADM.php");
                    }else{
                        $_SESSION['error']['Add_Curso'] = feedback_Submit("Curso cadastrado com sucesso", "success");
                        header("Location:../../Add_Curso.php");
                    }
                } else {
                    $_SESSION['error']['Add_Curso'] = feedback_Submit("Erro ao cadastrar, tente novamente", "erro");                    
                    header("Location:../../Add_CursoADM.php");
                }

            } else {
                $_SESSION['error']['Add_Curso'] = feedback_Submit("Plano: ".$Upload->getError()." - Capa:".$Capa->getError(), "erro");
                header("Location:../../Add_CursoADM.php");
            }
        }else{

            $dias = implode('', $form['dias']);

            $Insert = new Insert;
            $Insert->exeInsert("cursos", array(
                    'id_professor' => $_SESSION['user']['id'],
                    'nome' => $form['curso'],
                    'tipo' => $form['categoria'],
                    'data_inicio' => $form['data_i'],
                    'data_final' => $form['data_f'],
                    'carga_h' => $form['carga_h'],
                    'turno' => $form['turno'],
                    'horario' => $form['horario'],
                    'preco' => $form['preco'],
                    'id_dias' => $dias,
                    'descricao' => $form['desc'],
                    'status' => 1,
                    'capa' => $Capa->getName(),
                    'qtd_min_alun' => $form['alun_min'],
                    'qtd_max_alun' => $form['alun_max']
                )
            );

            if ($Insert->getLastId()) {
                if($_SESSION['user']['permicao'] == 1){
                    $_SESSION['error']['Add_Curso'] = feedback_Submit("Curso cadastrado com sucesso", "success");
                    header("Location:../../Add_CursoADM.php");
                }else{
                    $_SESSION['error']['Add_Curso'] = feedback_Submit("Curso cadastrado com sucesso", "success");
                    header("Location:../../Add_Curso.php");
                }
            } else {
                $_SESSION['error']['Add_Curso'] = feedback_Submit("Erro ao cadastrar, tente novamente", "erro");
                header("Location:../../Add_CursoADM.php");
            }

        }

    } else {
        $_SESSION['error']['Add_Curso'] = feedback_Submit("Preencha todos os campos", "erro");
        header("Location:../../Add_CursoADM.php");

    }


} else {

    // Professor
    if (!empty($form['curso']) AND !empty($form['carga_h']) AND !empty($form['desc']) AND !empty($form['tipo']) AND !empty($form['data_i']) AND !empty($_FILES['capa'])) {


        $Upload = new Upload;
        $Capa = new Upload;

        // Se tiver plano
        if( !empty($_FILES['plano']['name']) ){

            $Upload->setFile($_FILES['plano'], 20);
            $Capa->setImage($_FILES['capa'], 5, "Capas", null, 1);

            // Verificação de arquivo
            if ($Upload->getGo() == 3 AND $Capa->getGo() == 3) {

                // Insere no banco
                $Insert = new Insert;
                $Insert->exeInsert("cursos",
                    array(
                        'id_professor' => $_SESSION['user']['id'],
                        'nome' => $form['curso'],
                        'tipo' => $form['tipo'],
                        'data_inicio' => $form['data_i'],
                        'descricao' => $form['desc'],
                        'carga_h' => $form['carga_h'],
                        'status' => 3,
                        'plano' => $Upload->getName(),
                        'capa' => $Capa->getName()
                    )
                );

                if ($Insert->getLastId()) {
                    if($_SESSION['user']['permicao'] == 1){
                        $_SESSION['error']['Add_Curso'] = feedback_Submit("Curso cadastrado com sucesso", "success");
                        header("Location:../../Add_CursoADM.php");
                    }else {
                        $_SESSION['error']['Add_Curso'] = feedback_Submit( "Curso cadastrado com sucesso", "success");
                        header("Location:../../Add_Curso.php");
                    }
                } else {
                    $_SESSION['error']['Add_Curso'] = feedback_Submit("Erro ao cadastrar, tente novamente", "erro");
                    header("Location:../../Add_Curso.php");
                }

            } else {
                $_SESSION['error']['Add_Curso'] = feedback_Submit($Upload->getError(), "erro");
                header("Location:../../Add_Curso.php");
            }

        }else{

            $Capa->setImage($_FILES['capa'], 5, "Capas", null, 1);

            // Verificação de arquivo
            if ($Capa->getGo() == 3) {

                // Insere no banco
                $Insert = new Insert;
                $Insert->exeInsert("cursos",
                    array(
                        'id_professor' => $_SESSION['user']['id'],
                        'nome' => $form['curso'],
                        'tipo' => $form['tipo'],
                        'data_inicio' => $form['data_i'],
                        'descricao' => $form['desc'],
                        'carga_h' => $form['carga_h'],
                        'status' => 3,
                        'capa' => $Capa->getName()
                    )
                );

                if ($Insert->getLastId()) {
                    if($_SESSION['user']['permicao'] == 1){
                        $_SESSION['error']['Add_Curso'] = feedback_Submit("Curso cadastrado com sucesso", "success");
                        header("Location:../../Add_CursoADM.php");
                    }else {
                        $_SESSION['error']['Add_Curso'] = feedback_Submit( "Curso cadastrado com sucesso", "success");
                        header("Location:../../Add_Curso.php");
                    }
                } else {
                    $_SESSION['error']['Add_Curso'] = feedback_Submit("Erro ao cadastrar, tente novamente", "erro");
                    header("Location:../../Add_Curso.php");
                }

            } else {
                $_SESSION['error']['Add_Curso'] = feedback_Submit($Capa->getError(), "erro");
                header("Location:../../Add_Curso.php");
            }

        }




    } else {
        $_SESSION['error']['Add_Curso'] = feedback_Submit("Preencha todos os campos", "erro");
        header("Location:../../Add_Curso.php");
    }
}


function feedback_Submit($msg, $class){
    return "<div id='feedback_Submit' class='{$class}'>{$msg}</div>";
}