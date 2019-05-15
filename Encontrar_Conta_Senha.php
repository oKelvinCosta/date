<?php
session_start();
if (!empty($_SESSION['user'])) {
session_destroy();
}




// Seleciona o user pelo id

$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);




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

<section class="login">
    <div class="formulario">

        <div class="action">
            Crie uma nova senha
        </div>

            <?php
            if (!empty($_SESSION['Encontrar_Conta_Senha'])) {
                echo $_SESSION['Encontrar_Conta_Senha'];
            }
            ?>


        <form action="#" method="post" id="MyForm">
                <input type="hidden" name="idU" value="<?=$get['idU'];?>">

                <label class="label_material">
                    <input class="campo" type="password" name="senha" data-ordem="0" required>
                    <span class="placeholder">Senha</span>
                    <span class="line_bottom"></span>
                </label>
          
                <label class="label_material">
                    <input class="campo" type="password" name="csenha" data-ordem="1" required>
                    <span class="placeholder">Confirmar Senha</span>
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