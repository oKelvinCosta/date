<?php

require "../../_app/config.php";


//Side Menu

$Notif = new Select;
$Notif->fullSelect("SELECT U.nome AS Unome, C.nome AS Cnome, carga_h, id_curso FROM cursos AS C
 INNER JOIN usuarios AS U
 ON id_professor = id_user
 WHERE status = :status", array('status' => 3));

while ($N = $Notif->getResultAssoc()) {

    ?>


    <li class="box clearfix notions" data-id_curso-type="<?= $N['id_curso']; ?>">
        <div class="main clearfix">
            <div class="curso"><?= $N['Cnome']; ?></div>
            <div class="resp">
                <a href="" data-id_curso-type="<?= $N['id_curso']; ?>"></a>
                <a href="" data-id_curso-type="<?= $N['id_curso']; ?>"></a>
            </div>
        </div>
        <span class="criador"><?= $N['Unome']; ?></span>
    </li>


    <?php
}
?>