<?php

namespace src\views\includes;

$sessionOk = isset($_SESSION['login']) && $_SESSION['login'] == true ? true : false;
$welcome = $sessionOk ? "Olá, " . $_SESSION['firstName'] . "! " . ' <i class="icon icon-eye icon-user icon-white icon-24"></i>' : 'Fazer Login <i class="icon icon-log-in icon-24 icon-white"></i>';

?>

<nav class="navbar navbar-expand-md border-bottom border-body background-red" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand roboto-black" href="<?= SITE_ADDRESS ?>home/index"></i> THE BORING BLOG </a>
        <button class="navbar-toggler no-radius" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">&nbsp;</li>
                <?php if ($sessionOk == true) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITE_ADDRESS ?>posts/edit?sid=new">Novo post <i class="icon icon-file-plus icon-white icon-24"></i></a>
                    </li>
                <?php } ?>
                <?php if ($sessionOk == true) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITE_ADDRESS ?>posts/myposts">Meus posts <i class="icon icon-file icon-white icon-24"></i></a>
                    </li>
                <?php } ?>
            </ul>
            <div class="col-md-4" style="margin-right: 10px;">
                <form class="d-flex" id="form-search" role="search" action="<?= SITE_ADDRESS ?>search/index" method="get">
                    <input class="form-control no-radius" type="search" id="q" name="q" placeholder="Pesquisa" aria-label="Pesquisa">
                    <button class="btn no-radius background-dark" style="margin-left: 2px;" type="submit">
                        <i class="icon icon-search icon-16 icon-white"></i>
                    </button>
                </form>
            </div>
            <?php if ($sessionOk) { ?>
                <span class="navbar-text" style="padding-right: 10px; padding-top: 3px;">
                    <a class="nav-link" href="#">Olá, <?= $_SESSION['firstName'] ?>! <i class="icon icon-eye icon-user icon-white icon-24"></i></a>
                </span>
            <?php } else { ?>
                <span class="navbar-text" style="padding-right: 10px; padding-top: 3px;">
                    <a class="nav-link" href="<?= SITE_ADDRESS ?>login/index"> Login <i class="icon icon-log-in icon-24 icon-white"></i></a>
                </span>
            <?php } ?>
            <?php if ($sessionOk) { ?>
                <span class="navbar-text" style="padding-top: 3px;">
                    <a class="nav-link" href="<?= SITE_ADDRESS ?>login/logout"> Sair <i class="icon icon-log-out icon-24 icon-white"></i></a>
                </span>
            <?php } ?>
        </div>
    </div>
</nav>