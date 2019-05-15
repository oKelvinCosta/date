<?php
/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 10/01/2017
 * Time: 19:27
 */

require "../_app/config.php";
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);



    if (
        !empty($form['curso']) AND
        !empty($form['categoria']) AND
        !empty($form['data_i']) AND
        !empty($form['data_f']) AND
        !empty($form['carga_h']) AND
        !empty($form['turno']) AND
        !empty($form['horario']) AND
        !empty($form['preco']) AND
        !empty($form['prof']) AND
        !empty($form['desc']) AND
        !empty($form['alun_min']) AND
        !empty($form['alun_max']) AND
        !empty($form['dias'])
    ) {

        $Upload = new Upload;
        $Update = new Update;

        // Prepara algumas informações
        $dias = implode('', $form['dias']);
        
        
        // Se tiver PLANO e CAPA novO
        if (!empty($_FILES['plano']['name']) AND !empty($_FILES['capa']['name'])) {
            $_SESSION['bug'] = 1;

            // Deletar plano e capa antigo
            $Select = new Select;
            $Select->exeSelect("cursos", "WHERE id_curso = :id", array('id' => $form['id-curso']));

            $Plano = $Select->getResultAssoc();
            $Capa = $Plano['capa'];
            $Plano = $Plano['plano'];

            if($Plano){
                if(file_exists("../Uploads/Plano_de_Curso/" . $Plano)){
                    unlink("../Uploads/Plano_de_Curso/" . $Plano);
                }
            }

            if($Capa){
                if(file_exists("../Uploads/Capas/" . $Capa)){
                    unlink("../Uploads/Capas/" . $Capa);
                }
            }


            // --

            $Capa = new Upload;

                $Upload->setFile($_FILES['plano'], 20, "../Uploads/Plano_de_Curso");
                $Capa->setImage($_FILES['capa'], 5, "Capas", "../Uploads", 1);


                // Verificação de arquivo
                if ($Upload->getGo() == 3 AND $Capa->getGo() == 3) {
                    $_SESSION['bug'] = 2;

                   

                    // Update no banco
                    $Update->exeUpdate("cursos",
                        "
                id_curso = :id,
                nome = :nome,
                tipo = :tipo,
                 data_inicio = :data_inicio,
                data_final = :data_final,
                carga_h = :carga_h,
                turno = :turno,
                horario = :horario,
                preco = :preco,
                id_professor = :id_professor,
                descricao = :desc,
                id_dias = :id_dias,
                plano = :plano,
                capa = :capa,
                status = :status,
                qtd_min_alun = :min,
                qtd_max_alun = :max
                ",
                        "WHERE id_curso = :id",
                        array(
                            'id' => $form['id-curso'],
                            'nome' => $form['curso'],
                            'tipo' => $form['categoria'],
                            'data_inicio' => $form['data_i'],
                            'data_final' => $form['data_f'],
                            'carga_h' => $form['carga_h'],
                            'turno' => $form['turno'],
                            'horario' => $form['horario'],
                            'preco' => $form['preco'],
                            'id_professor' => $form['prof'],
                            'desc' => $form['desc'],
                            'id_dias' => $dias,
                            'plano' => $Upload->getName(),
                            'capa' => $Capa->getName(),
                            'status' => 1,
                            'min' => $form['alun_min'],
                            'max' => $form['alun_max']
                        )
                    );


                }


        } elseif ( !empty($_FILES['plano']['name']) AND empty($_FILES['capa']['name'])) {
            // Plano novo e ja tinha capa

            // Deletar plano antigo
            $Select = new Select;
            $Select->exeSelect("cursos", "WHERE id_curso = :id", array('id' => $form['id-curso']));

            $Plano = $Select->getResultAssoc();
            $Plano = $Plano['plano'];

            if($Plano){
                if(file_exists("../Uploads/Plano_de_Curso/" . $Plano)){
                    unlink("../Uploads/Plano_de_Curso/" . $Plano);
                }
            }

           


            // --

            $Capa = new Upload;

            $Upload->setFile($_FILES['plano'], 20, "../Uploads/Plano_de_Curso");


            // Verificação de arquivo
            if ($Upload->getGo() == 3 ) {
                
                // Update no banco
                $Update->exeUpdate("cursos",
                    "
                id_curso = :id,
                nome = :nome,
                tipo = :tipo,
                 data_inicio = :data_inicio,
                data_final = :data_final,
                carga_h = :carga_h,
                turno = :turno,
                horario = :horario,
                preco = :preco,
                id_professor = :id_professor,
                descricao = :desc,
                id_dias = :id_dias,
                plano = :plano,
                status = :status,
                qtd_min_alun = :min,
                qtd_max_alun = :max
                ",
                    "WHERE id_curso = :id",
                    array(
                        'id' => $form['id-curso'],
                        'nome' => $form['curso'],
                        'tipo' => $form['categoria'],
                        'data_inicio' => $form['data_i'],
                        'data_final' => $form['data_f'],
                        'carga_h' => $form['carga_h'],
                        'turno' => $form['turno'],
                        'horario' => $form['horario'],
                        'preco' => $form['preco'],
                        'id_professor' => $form['prof'],
                        'desc' => $form['desc'],
                        'id_dias' => $dias,
                        'plano' => $Upload->getName(),
                        'status' => 1,
                        'min' => $form['alun_min'],
                        'max' => $form['alun_max']
                    )
                );


            }
            
        }elseif ( empty($_FILES['plano']['name']) AND !empty($_FILES['capa']['name'])) {
            // Capa nova e ja tinha plano

            // Deletar plano e capa antigo
            $Select = new Select;
            $Select->exeSelect("cursos", "WHERE id_curso = :id", array('id' => $form['id-curso']));

            $Plano = $Select->getResultAssoc();
            $Capa = $Plano['capa'];

          

            if($Capa){
                if(file_exists("../Uploads/Capas/" . $Capa)){
                    unlink("../Uploads/Capas/" . $Capa);
                }
            }


            // --

            $Capa = new Upload;
            $Capa->setImage($_FILES['capa'], 5, "Capas", "../Uploads", 1);


            // Verificação de arquivo
            if ( $Capa->getGo() == 3) {

                // Update no banco
                $Update->exeUpdate("cursos",
                    "
                id_curso = :id,
                nome = :nome,
                tipo = :tipo,
                 data_inicio = :data_inicio,
                data_final = :data_final,
                carga_h = :carga_h,
                turno = :turno,
                horario = :horario,
                preco = :preco,
                id_professor = :id_professor,
                descricao = :desc,
                id_dias = :id_dias,
                capa = :capa,
                status = :status,
                qtd_min_alun = :min,
                qtd_max_alun = :max
                ",
                    "WHERE id_curso = :id",
                    array(
                        'id' => $form['id-curso'],
                        'nome' => $form['curso'],
                        'tipo' => $form['categoria'],
                        'data_inicio' => $form['data_i'],
                        'data_final' => $form['data_f'],
                        'carga_h' => $form['carga_h'],
                        'turno' => $form['turno'],
                        'horario' => $form['horario'],
                        'preco' => $form['preco'],
                        'id_professor' => $form['prof'],
                        'desc' => $form['desc'],
                        'id_dias' => $dias,
                        'capa' => $Capa->getName(),
                        'status' => 1,
                        'min' => $form['alun_min'],
                        'max' => $form['alun_max']
                    )
                );


            }
            
        }else {
            $_SESSION['bug'] = 3;
            // Se nao tiver plano e capa novas

            

            // Update no banco
            $Update->exeUpdate("cursos",
                "
                id_curso = :id,
                nome = :nome,
                tipo = :tipo,
                 data_inicio = :data_inicio,
                data_final = :data_final,
                carga_h = :carga_h,
                turno = :turno,
                horario = :horario,
                preco = :preco,
                id_professor = :id_professor,
                descricao = :desc,
                id_dias = :id_dias,
                status = :status,
                qtd_min_alun = :min,
                qtd_max_alun = :max
                ",
                "WHERE id_curso = :id",
                array(
                    'id' => $form['id-curso'],
                    'nome' => $form['curso'],
                    'tipo' => $form['categoria'],
                    'data_inicio' => $form['data_i'],
                    'data_final' => $form['data_f'],
                    'carga_h' => $form['carga_h'],
                    'turno' => $form['turno'],
                    'horario' => $form['horario'],
                    'preco' => $form['preco'],
                    'id_professor' => $form['prof'],
                    'desc' => $form['desc'],
                    'id_dias' => $dias,
                    'status' => 1,
                    'min' => $form['alun_min'],
                    'max' => $form['alun_max']
                )
            );

        }


    }





require "../Parts/Manutencao_Cursos_Content.php";
?>