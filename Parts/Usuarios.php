<?php
// Mostrar usuarios nao excluidos
while ($User = $Select->getResultAssoc()) {
    ?>
    <!--BOX-->
    <div class=" user box info_user" data-user_id-type="<?= $User['id_user']; ?>">
        <div class="name"><?= $User['nome']; ?></div>
        <div class="img"><img src="Uploads/Usuarios/<?= $User['foto']; ?>" alt="Foto<?= $User['nome']; ?>">
        </div>
        <div class="buttons">
            <label class="user_editar" data-user_id-type="<?= $User['id_user']; ?>">Editar</label>
            <?php
            if ($User['desligado'] == 1) {
                ?>
                <label class="user_readicionar" data-user_id-type="<?= $User['id_user']; ?>">Readicionar</label>
                <?php
            } else {
                ?>
                <label class="user_excluir" data-user_id-type="<?= $User['id_user']; ?>">Excluir</label>
                <?php
            }
            ?>
        </div>
        <!--MODAL INFO-->

        <!--FIM MODAL INFO-->
    </div>
    <!--FIM BOX-->
    <?php
}
?>