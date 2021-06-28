<?php
session_start();
if(!empty($_SESSION['Id_Usuario'])){
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../lib/css/bootstrap3.min.css">
        <script src="../lib/js/jquery.min.js"></script>
        <script src="../lib/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Sistema Web</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
            
                    <li><a href="logout.php">Salir</a></li>
                </ul>
            </div>
        </nav>
        <div class="container" align="center">
            <h3>Hola <?php echo $_SESSION['Nombre_Completo']; ?>Bienvenido al Sistema</>
        </div>
    </body>
</html>
<?php
}else{
    header('Location:signin.php');
}
?>