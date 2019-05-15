<?php
require "../../_app/config.php";


$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);

// ADD
if ($get['Acao'] == 1) {

    $Selec = new Select;
    $Selec->exeSelect("cursos", "WHERE id_curso = :id", array('id' => $get['idCurso']));
    $Res = $Selec->getResultAssoc();

    // Para nao add mais do Maximo
    if($Res['alun_matriculado'] < $Res['qtd_max_alun']){

        $add = $Res['alun_matriculado'] + 1;

        $Update = new Update;
        $Update->exeUpdate("cursos", "alun_matriculado = :add", "WHERE id_curso = :id", array('id' => $get['idCurso'], 'add' => $add));


        $Selec->exeSelect("cursos", "WHERE id_curso = :id", array('id' => $get['idCurso']));
        $show = $Selec->getResultAssoc();

        echo showColorAtual($show['alun_matriculado'], $show['qtd_min_alun']);
    }else{
        echo showColorAtual($Res['alun_matriculado'], $Res['qtd_min_alun']);
    }

} else {
    // SUB

    $Selec = new Select;
    $Selec->exeSelect("cursos", "WHERE id_curso = :id", array('id' => $get['idCurso']));
    $Res = $Selec->getResultAssoc();


    // Para não ficar negative
    if($Res['alun_matriculado'] > 0){

        $sub = $Res['alun_matriculado'] - 1;

        $Update = new Update;
        $Update->exeUpdate("cursos", "alun_matriculado = :sub", "WHERE id_curso = :id", array('id' => $get['idCurso'], 'sub' => $sub));


        $Selec->exeSelect("cursos", "WHERE id_curso = :id", array('id' => $get['idCurso']));
        $show = $Selec->getResultAssoc();

        echo showColorAtual($show['alun_matriculado'], $show['qtd_min_alun']);

    }else{
        echo showColorAtual($Res['alun_matriculado'], $Res['qtd_min_alun']);
    }

}

function showColorAtual($Aluno_atual, $Qtd_min){

    // Muda a cor e coloca 0 se for menor que 10

    // red
    if($Aluno_atual < $Qtd_min){

        if($Aluno_atual < 10){
            $red = "<span style='color:  #ff2b41'>0".$Aluno_atual.'</span>';
        }else{
            $red = "<span style='color:  #ff2b41'>".$Aluno_atual.'</span>';
        }

        return $red;

    }else{
        // green
        if($Aluno_atual < 10){
            $green = "<span style='color:  #1dc462'>0".$Aluno_atual.'</span>';
        }else{
            $green = "<span style='color:  #1dc462'>".$Aluno_atual.'</span>';
        }

        return$green;
    }

}