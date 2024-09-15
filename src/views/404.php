<?php

namespace src\views;

?>

<!DOCTYPE html>
<html>

<head>
    <title>404</title>
    <meta charset="utf-8" lang="pt-br">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="<?= SITE_PUBLIC ?>css/bootstrap-5.3.3.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH">
    <link href="<?= SITE_PUBLIC ?>css/roboto.css" rel="stylesheet">
    <link href="<?= SITE_PUBLIC ?>css/select2.min.css" rel="stylesheet">
    <link href="<?= SITE_PUBLIC ?>css/principal.css" rel="stylesheet">
    <link href="<?= SITE_PUBLIC ?>css/icons.css" rel="stylesheet">
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
        <p class="roboto-bold">Página não encontrada</p>
        <br>
        <a class="roboto-thin-bold" href="<?= SITE_ADDRESS . "home/index" ?>">Voltar para o início</a>
    </div>
</body>

</html>