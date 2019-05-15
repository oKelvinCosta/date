<?php
require "../_app/config1.php";

$Insert = new Insert;
$Insert->exeInsert("newsletter", array('email' => $_POST['email']));


$_SESSION['error'] = array(); 

if($Insert->getLastId()){
    echo "<script>history.back();</script>";
    $_SESSION['error']['newsletter'] = feedback_Submit("Email enviado com sucesso!", "success");
}else{
    echo "<script>history.back();</script>";
}

function feedback_Submit($msg, $class){
    return "<div id='feedback_Submit' class='{$class}'>{$msg}</div>";
}