<input type="checkbox" hidden id="toggle">
<div class="toggle box">
    <div class="top clearfix">
        <h3>MENU</h3>
    </div>
    <ul>
        <li><a href="Perfil.php"><?= $_SESSION['user']['nome']; ?></a></li>
        <li><a href="index.php">Logout</a></li>
        <br>
        <li><a href="Home.php">Calendário</a></li>
        <?php
        if ($_SESSION['user']['permicao'] != 3) {
            ?>
            <li><a href="Calendar.php">Calendário Detalhado</a></li>
            <?php
            if ($_SESSION['user']['permicao'] == 2) {
                ?>
                <li><a href="Add_Curso.php">Adicionar Curso</a></li>
                <?php
            } ?>
            <?php
            if ($_SESSION['user']['permicao'] == 1) {
                ?>
                <li><a href="Add_CursoADM.php">Adicionar Curso</a></li>

                <li><a href="Manutencao_Cursos.php">Manutenção Cursos</a></li>

                <li><a href="Add_User.php">Adicionar Usuário</a></li>
            
                <?php

                // Desabilitei para que usuários Testers não apague outros usuários
                // <li><a href="Users.php">Usuários</a></li>
                // <li><a href="Ex_Users.php">Ex Usuários</a></li>
            }
        }

        if ($_SESSION['user']['permicao'] != 1) {
            ?>
            <li><a href="Manutencao_Cursos_Basico.php">Manutenção Cursos</a></li>
            <?php
        }

        ?>
    </ul>
</div>
