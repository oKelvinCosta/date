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
    <title>Title</title>
    <meta name="keywords" content="html, login, date, senai">
    <meta name="description" content="DATE, um site calendário para seus cursos!">
    <meta name="author" content="Kelvin Costa">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/General.css" type="text/css">
	<link rel="stylesheet" href="css/Form.css" type="text/css">
    <style>

    </style>
</head>
<body>

<header>
    <img src="img/logo_login.png" alt="logo date!" title="logo date!">
</header>

<section class="login send_email">
    <div class="formulario">

        <div class="action">
            Envie um link de confirmação para seu email
        </div>

            <?php
            if (!empty($_SESSION['Encontrar_Conta_Email'])) {
                echo $_SESSION['Encontrar_Conta_Email'];
            }
            ?>


        <form action="#" method="post" id="MyForm">

				
                <label class="label_material">
                    <input class="campo" type="text" name="email" data-ordem="0" required>
                    <span class="placeholder">Email</span>
                    <span class="line_bottom"></span>
                </label>
          

            <input class="submit_login botao" id="submit" type="submit" value="ENVIAR">
        </form>

       

        <div class="esqueceu">
            <a href="index.php">Login</a>
        </div>


        <ul class="direitos">
            <li>Designing By Kelvin Costa</li>
            <li>Copyright 2016, Todos os direitos reservados SENAI</li>
        </ul>

    </div>


</section>

</body>
</html>

<?php

// Função envia Email com o id do usuário que possui o email digitado