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
</head>

<body>
    <?php require 'src/includes/header.php'; ?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <h3 class="roboto-black text-red">Em alta nessa semana</h3>
                <?php
                $i = 0;
                foreach ($threads as $item) {
                    $i++;
                ?>
                    <div class="row">
                        <a class="link-offset-2 link-underline link-underline-opacity-0 text-black" href="<?= SITE_ADDRESS ?>posts/index?sid=<?= $item['id'] ?>">
                            <span class="badge text-bg-secondary"><?= $item['categoryDescription'] ?></span>
                            <h5 class="roboto-bold"><?= "$i. " . $item['title'] ?> </h5>
                        </a>
                        <p class="roboto-regular"><?= $item['subtitle'] ?></p>
                        <small></small>
                        <small class="roboto-regular font-11"> <i class="icon icon-eye icon-black icon-16"></i> <?= $item['views'] . " visualizações." ?>
                            Postado por <?= $item['userFirstName'] . " " . $item['userLastName'] ?> em <?= Util::dateFromDb($item['registeredAt']) ?>
                        </small>
                    </div>
                    <br>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <h3 class="roboto-black text-red">Últimas postagens</h3>
                <?php foreach ($lastsPosts as $item) { ?>
                    <div class="row">
                        <a class="link-offset-2 link-underline link-underline-opacity-0 text-black" href="<?= SITE_ADDRESS ?>posts/index?sid=<?= $item['id'] ?>">
                            <span class="badge text-bg-secondary"><?= $item['categoryDescription'] ?></span>
                            <h5 class="roboto-bold"><?= $item['title'] ?> </h5>
                        </a>
                        <p class="roboto-regular"><?= $item['subtitle'] ?></p>
                        <small></small>
                        <small class="roboto-regular font-11"> <i class="icon icon-eye icon-black icon-16"></i> <?= $item['views'] . " visualizações." ?>
                            Postado por <?= $item['userFirstName'] . " " . $item['userLastName'] ?> em <?= Util::dateFromDb($item['registeredAt']) ?>
                        </small>
                    </div>
                    <br>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php require 'src/includes/footer.php'; ?>
</body>

</html>