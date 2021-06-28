<?php
    session_start();
    $_SESSION['Id_Usuario']='';
    $_SESSION['Nombre_Completo']='';
    header('Location:signin.php');
?>