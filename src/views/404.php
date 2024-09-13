<?php

namespace src\views;

?>

<!DOCTYPE html>
<html>

<head>
    <title>404</title>
    <meta charset="utf-8" lang="pt-br">
    <style>
        a {
            text-decoration: none;
            color: #000000;
        }
    </style>
</head>

<body>
    <div style="text-align: center;">
        <img width="500" height="300" src="<?= SITE_PUBLIC ?>img/404-not-found.svg" alt="Página não encontrada">
        <h2>Página não encontrada</h2>
        <br>
        <a href="<?= SITE_ADDRESS . "home/index" ?>">Voltar para o início</a>
    </div>
</body>

</html>