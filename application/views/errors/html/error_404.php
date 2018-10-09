<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Algo extraño sucedio..</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/404.css">
</head>
<body>
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>Oops!</h1>
        </div>
        <h2>404 - Pagina no encontrada</h2>
        <p>La página que está buscando podría haber sido eliminada si su nombre hubiera cambiado o no esté disponible temporalmente.</p>
        <a href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>">IR A LA PÁGINA INICIAL</a>
    </div>
</div>

</body>
</html>