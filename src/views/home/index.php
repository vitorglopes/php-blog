<?php

namespace src\view\home;

use src\core\Util;

$threads = $data['threads']['data'];
$lastsPosts = $data['lastsPosts']['data'];

?>

<!DOCTYPE html>
<html>

<head>
    <?php require 'src/includes/head.php'; ?>
    <style>
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: scale(1.05) rotateY(10deg);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .card-img-overlay {
            backdrop-filter: blur(5px);
        }
    </style>
</head>

<body>
    <?php require 'src/includes/header.php'; ?>
    <div class="container" id="page-container">
        <div class="row mt-4">
            <div class="col-md-12">
                <h3 class="roboto-black text-red">Em alta nessa semana</h3>
                <div class="row">
                    <?php
                    $i = 0;
                    foreach ($threads as $item) {
                        $i++;
                    ?>
                        <div class="col-md-4 mb-4">
                            <a class="link-offset-2 link-underline link-underline-opacity-0 text-black" href="<?= SITE_ADDRESS ?>posts/index?sid=<?= $item['id'] ?>">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="badge bg-info"><?= $item['categoryDescription'] ?></span>
                                        <h5 class="roboto-bold"><?= "$i. " . $item['title'] ?> </h5>

                                        <p class="roboto-regular"><?= $item['subtitle'] ?></p>
                                        <small class="roboto-regular font-11">
                                            <i class="icon icon-eye icon-black icon-16"></i> <?= $item['views'] ?>
                                            <i class="icon icon-eye icon-user icon-16"></i> <?= $item['userFirstName'] . " " . $item['userLastName'] ?> em <?= Util::dateFromDb($item['registeredAt']) ?>
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12" id="content-wrap">
                <h3 class="roboto-black text-red">Últimas publicações</h3>
                <div class="row">
                    <?php foreach ($lastsPosts as $item) { ?>
                        <div class="col-md-4 mb-4">
                            <a class="link-offset-2 link-underline link-underline-opacity-0 text-black" href="<?= SITE_ADDRESS ?>posts/index?sid=<?= $item['id'] ?>">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="badge bg-info"><?= $item['categoryDescription'] ?></span>
                                        <h5 class="roboto-bold"><?= $item['title'] ?> </h5>
                                        <p class="roboto-regular"><?= $item['subtitle'] ?></p>
                                        <small class="roboto-regular font-11">
                                            <i class="icon icon-eye icon-black icon-16"></i> <?= $item['views'] ?>
                                            <i class="icon icon-eye icon-user icon-16"></i> <?= $item['userFirstName'] . " " . $item['userLastName'] ?> em <?= Util::dateFromDb($item['registeredAt']) ?>
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php require 'src/includes/footer.php'; ?>
</body>

</html>