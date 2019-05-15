<?php
session_start();
if (!empty($_SESSION['user'])) {
session_destroy();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Date | Calendário de Cursos!</title>
    <meta name="keywords" content="date, senai, cecoteg, cursos, agendamento, calendario">
    <meta name="description" content="DATE, um site calendário para seus cursos!">
    <meta name="author" content="Kelvin Costa">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/General.css" type="text/css">
	<link rel="stylesheet" href="css/Form.css" type="text/css">

    <link rel="icon" href="img/Favicon/Date16.png" sizes="16x16">
    <link rel="icon" href="img/Favicon/Date32.png" sizes="32x32">
    <link rel="icon" href="img/Favicon/Date48.png" sizes="48x48">
    <link rel="icon" href="img/Favicon/Date64.png" sizes="64x64">
    <link rel="icon" href="img/Favicon/Date128.png" sizes="128x128">

</head>
<body>

<header>
    <img src="img/Logo/logoWhite.svg" alt="logo date!" title="logo date!" style="max-width: 350px">
</header>

<section class="login">
    <div class="formulario">

        <?php
        if (!empty($_SESSION['error']['Login'])) {
            echo $_SESSION['error']['Login'];
        }
        ?>

        <form action="back/Login.php" method="post">

				
                <label class="label_material">
                    <input class="campo" type="text" name="email" data-ordem="0" required>
                    <span class="placeholder">Email</span>
                    <span class="line_bottom"></span>
                </label>

				<label class="label_material">
                    <input class="campo" type="password" name="senha" data-ordem="0" required>
                    <span class="placeholder">Senha</span>
                    <span class="line_bottom"></span>
                </label>
          

            <input class="submit_login botao" type="submit" value="LOGIN">
        </form>

<!--        <div class="esqueceu">-->
<!--            <a href="Encontrar_Conta_Email.php">Encontrar minha conta</a>-->
<!--        </div>-->


        <ul class="direitos">
            <li>Feito por KELVIN COSTA</li>
            <li>© 2017 SENAI - Todos os direitos reservados.</li>
        </ul>

    </div>


</section>


</body>
</html>