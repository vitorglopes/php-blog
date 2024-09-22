<?php

namespace src\views\includes;

$sessionOk = isset($_SESSION['login']) && $_SESSION['login'] == true ? true : false;
$welcome = $sessionOk ? "Olá, " . $_SESSION['firstName'] . "! " . ' <i class="icon icon-eye icon-user icon-white icon-24"></i>' : "Fazer Login";

?>

<nav class="navbar navbar-expand-md border-bottom border-body background-red" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand roboto-black" href="<?= SITE_ADDRESS ?>home/index"></i> THE BORING BLOG <i class="icon icon-monitor icon-white icon-24"></i></a>
        <button class="navbar-toggler no-radius" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">&nbsp;</li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_ADDRESS ?>threads/index">Tendências <i class="icon icon-activity icon-white icon-24"></i></a>
                </li>
                <?php if ($sessionOk == true) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITE_ADDRESS ?>posts/edit">Novo post <i class="icon icon-file-plus icon-white icon-24"></i></a>
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
            <span class="navbar-text">
                <a class="nav-link" href="<?= SITE_ADDRESS ?>login/index"><?= $welcome ?></a>
            </span>
            <!-- <ul>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul> -->
        </div>
    </div>
</nav>