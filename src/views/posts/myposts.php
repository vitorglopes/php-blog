<?php

namespace src\views;

use src\core\Util;

$myposts = $data['data'];
$userSession = isset($_SESSION['userId']) ? $_SESSION['userId'] : 0;

?>
<!DOCTYPE html>
<html>

<head>
    <?php require 'src\includes\head.php'; ?>
</head>

<body>
    <?php require 'src\includes\header.php'; ?>
    <div class="container" id="page-container">
        <div class="row mt-4">
            <h3 class="roboto-black text-red">Minhas postagens</h3>
            <?php foreach ($myposts as $item) { ?>
                <div class="row">
                    <a class="link-offset-2 link-underline link-underline-opacity-0 text-black" href="<?= SITE_ADDRESS ?>posts/index?sid=<?= $item['id'] ?>">
                        <span class="badge text-bg-secondary">
                            <?= empty($item['title']) || empty($item['subtitle']) ? 'Rascunho' : $item['categoryDescription'] ?>
                        </span>
                        <h5 class="roboto-bold"><?= !empty($item['title']) ? $item['title'] : '<i class="icon icon-edit-2 icon-16 icon-black"></i> Rascunho ' ?> </h5>
                    </a>
                    <p class="roboto-regular"><?= $item['subtitle'] ?></p>
                    <small class="roboto-regular font-11">
                        <i class="icon icon-eye icon-black icon-16"></i> <?= $item['views'] . " visualizações." ?>
                        <i class="icon icon-eye icon-user icon-16"></i> Postado em <?= Util::dateFromDb($item['registeredAt']) ?>
                    </small>
                </div>
                <?php if ($sessionOk && $item['userId'] == $userSession) { ?>
                    <div class="text-end">
                        <a href="<?= SITE_ADDRESS ?>posts/edit?sid=<?= $item['id'] ?>">
                            <button class="btn btn-dark">Editar <i class="icon icon-edit icon-16 icon-white"></i></button>
                        </a>
                    </div>
                <?php } ?>
                <br>
                <br>
                <hr>
            <?php } ?>
            <nav>
                <br>
                <ul class="pagination justify-content-center">
                    <?php if ($data['currentPage'] > 1) { ?>
                        <li class="page-item">
                            <a class="page-link no-radius text-black" href="?page=<?= $data['currentPage'] - 1 ?>" aria-label="Anterior">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php for ($i = 1; $i <= $data['lastPage']; $i++) { ?>
                        <li class="page-item <?= $i == $data['currentPage'] ? 'active' : '' ?>">
                            <a class="page-link no-radius <?= $i == $data['currentPage'] ? 'background-red white-border-color text-white' : 'text-black' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php } ?>

                    <?php if ($data['currentPage'] < $data['lastPage']) { ?>
                        <li class="page-item">
                            <a class="page-link no-radius text-black" href="?page=<?= $data['currentPage'] + 1 ?>" aria-label="Próximo">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
    <?php require 'src\includes\footer.php'; ?>
</body>

</html>