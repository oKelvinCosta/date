<?php
require "../../_app/config.php";


$Not = new Select;
$Not->exeSelect("cursos", "WHERE status = :status", array('status' => 3));

if ($Not->getRows() == 0) {
    $classNot = "notifica_empty";
} else {
    $classNot = "";
}

?>

<label class="icon_notifica <?= $classNot; ?>" for="side">
                        <span id="count_not">
                    <?php
                    echo $Not->getRows();
                    ?>
                        </span>
    <span>!</span>
</label>