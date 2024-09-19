<?php

namespace src\view\search;

use src\core\Util;

$search = $data['search'];
$data = $data['data']['data'];

?>

<!DOCTYPE html>
<html>

<head>
    <?php require 'src/includes/head.php'; ?>
</head>

<body>
    <?php require 'src/includes/header.php'; ?>
    <div class="container" id="page-container">
        <div class="row mt-4" id="content-wrap">
            <div class="col-md-12">
                <h3 class="roboto-regular">Exibindo resultados para "<strong><?= $search ?></strong>":</h3>
                <br>
                <?php
                if (empty($data)) { ?>
                    <div class="row text-center">
                        <img class="rounded mx-auto d-block" src="<?= SITE_PUBLIC_IMG ?>chicken-eating-worm.svg" style="max-width: 400px; max-heigth: 400px;"></img>
                        <h4 class="roboto-regular">Sem resultados.</h4>
                    </div>
                    <?php
                } else {
                    foreach ($data as $item) { ?>
                        <div class="row">
                            <a class="link-offset-2 link-underline link-underline-opacity-0 text-black" href="<?= SITE_ADDRESS ?>posts/index?sid=<?= $item['id'] ?>">
                                <h5 class="roboto-bold text-red"><?= '[' . $item['categoryDescription'] . '] ' . $item['title'] ?> </h5>
                            </a>
                            <p class="roboto-regular"><?= $item['subtitle'] ?></p>
                            <small></small>
                            <small class="roboto-regular font-11">
                                <i class="icon icon-eye icon-black icon-16"></i> <?= $item['views'] . " visualizações." ?>
                                <i class="icon icon-eye icon-user icon-16"></i> <?= $item['userFirstName'] . " " . $item['userLastName'] ?> em <?= Util::dateFromDb($item['registeredAt']) ?>
                            </small>
                        </div>
                        <br>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php require 'src/includes/footer.php'; ?>
</body>

</html>