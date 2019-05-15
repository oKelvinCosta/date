<?php

if ($_SESSION['user']['permicao'] == 1) {
    ?>
    <div class="side box">
        <div class="top clearfix">
            <h3> Notificações</h3>
        </div>


        <ul class="notifica" id="conteiner_notificacao">

            <?php
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
                    </div>
                    <span class="criador"><?= $N['Unome']; ?></span>
                </li>


                <?php
            }
            ?>
        </ul>
    </div>
    <?php
}