<?php

namespace src\views\includes;

?>

<nav class="navbar navbar-expand-md bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand roboto-black" href="<?= SITE_ADDRESS ?>home/index"></i> THE BORING BLOG <i class="icon icon-monitor icon-white icon-24"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">&nbsp;</li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_ADDRESS ?>threads/index">Tendências <i class="icon icon-activity icon-white icon-16"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_ADDRESS ?>posts/new">Novo post <i class="icon icon-plus-circle icon-white icon-16"></i></a>
                </li>
            </ul>
            <div class="col-md-4" style="margin-right: 10px;">
                <form class="d-flex" id="form-search" role="search" action="<?= SITE_ADDRESS ?>search/index" method="get">
                    <input class="form-control no-radius" type="search" id="q" name="q" placeholder="Pesquisa" aria-label="Pesquisa">
                    <button class="btn btn-secondary no-radius" style="margin-left: 2px;" type="submit">
                        <i class="icon icon-search icon-16 icon-white"></i>
                    </button>
                </form>
            </div>
            <span class="navbar-text">
                <a class="nav-link" href="<?= SITE_ADDRESS ?>login/index"> Fazer Login</a>
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