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

    <style>

    </style>
</head>
<body>

<header>
    <img src="img/logo_login.png" alt="logo date!" title="logo date!">
</header>

<section class="login">
    <div class="formulario">

        <div id="feedback" class="feedback">
            <p>Esqueceu a senha?</p>
            <?php
                echo @$_SESSION['error'];
            ?>
        </div>

        <form action="#" onsubmit="return false;" method="post" id="MyForm">
            <label class="label_m">
                <input type="text" required placeholder="Email ou Nome da conta a encontrar" name="recover">
                <span></span>
            </label>
            <label class="label_m">
                <input type="email" required placeholder="Email para enviar a confirmação" name="email">
                <span></span>
            </label>

            <input class="submit_login" id="submit" type="submit" value="ENVIAR PARA EMAIL">
        </form>

        <div class="esqueceu">
            <a href="index.php">Login</a>
            <a href="EsqueceuEmail.php">Email?</a>
        </div>


        <ul class="direitos">
            <li>Designing By Kelvin Costa</li>
            <li>Copyright 2016, Todos os direitos reservados SENAI</li>
        </ul>

    </div>


</section>


<script>
    var email_certo = id('email_certo');
    var submit = id('submit');
    var form = id('MyForm');



    submit.onclick = function () {
        loadDoc_Email("back/Esqueceu/Senha.php");
    };


    function loadDoc_Email(Url) {

        var formData = new FormData(form);

        var jax = new XMLHttpRequest;
        jax.onreadystatechange = function () {
          if(jax.readyState == 4 && jax.status == 200){
              email_certo.innerHTML = jax.responseText;
          }
        };
        jax.open("POST", Url, true);
        jax.send(formData);

    }











        function id(id) {
            return document.getElementById(id);
        }


    function className(className) {
        return document.getElementsByClassName(className);
    }
</script>

</body>
</html>