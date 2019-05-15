<nav class="menu">
    <div class="container clearfix">
        <ul class="logo">
            <li><a href="Home.php"><img src="img/Logo/logoWhite.svg" alt="date" title="date"></a></li>
        </ul>
        <ul class="menu_list">
            <?php
            if ($_SESSION['user']['permicao'] == 1) {
                ?>
                <li id="count_not">

                    <?php

                    $Not = new Select;
                    $Not->exeSelect("cursos", "WHERE status = :status", array('status' => 3));

                    if($Not->getRows() == 0){
                        $classNot = "notifica_empty";
                    }else{
                        $classNot = "";
                    }

                    ?>

                    <label class="icon_notifica <?= $classNot;?>" for="side">
                        <span>
                    <?php
                    echo $Not->getRows();
                    ?>
                        </span>
                        <span>!</span>
                    </label>
                </li>
                <?php
            }
            ?>
            <li>
                <label for="toggle" id="toMenu">
                    <div class="barra"></div>
                    <div class="barra"></div>
                    <div class="barra"></div>
                </label>
            </li>
        </ul>
    </div>

    <div id="menu_highlight">
        <!--SIDE-->
        <?php
        if ($_SESSION['user']['permicao'] == 1) {
            require_once "Side_Menu.php";
        }
        ?>
        <!--FIM SIDE-->


        <!--MENU-->
        <?php
        require_once "Menu.php";
        ?>
    </div>
    <!--FIM MENU-->

</nav>