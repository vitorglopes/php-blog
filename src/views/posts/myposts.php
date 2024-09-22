<?php

namespace src\views;

use src\core\Util;

$posts = $data['posts'];
$myposts = $posts['data'];
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
            <h3 class="roboto-black text-red">Minhas Publicações (<?= $posts['total'] ?>)</h3>
            <?php foreach ($myposts as $item) {
                $linkToPost = $item['status'] != 'draft' ? SITE_ADDRESS . "posts/index?sid=" . $item['id'] : '#';
            ?>
                <div class="row">
                    <h5 class="roboto-bold">
                        <?php
                        switch ($item['status']) {
                            case 'ok':
                                echo '<span class="badge bg-success"> Publicado </span>';
                                break;

                            case 'draft':
                                echo '<span class="badge bg-warning text-black">Rascunho <i class="icon icon-edit-2 icon-16 icon-black"></i></span>';
                                break;

                            case 'hidden':
                                echo '<span class="badge bg-dark"> Privado </span>';
                                break;
                        }
                        ?>
                        <?= !empty($item['title']) ? $item['title'] : ' Sem título ' ?>
                    </h5>
                    <p class="roboto-regular"><?= !empty($item['subtitle']) ? $item['subtitle'] : 'Sem conteúdo.' ?></p>

                    <?php if ($item['status'] != 'draft') { ?>
                        <h6>
                            <span class="badge bg-info"> <?= $item['categoryDescription'] ?></span>
                            <small class="roboto-regular font-11">
                                · <i class="icon icon-eye icon-black icon-16"></i> <?= $item['views'] ?> ·
                                <i class="icon icon-file-text icon-16"></i> Publicado em <?= Util::dateFromDb($item['registeredAt']) ?>
                            </small>
                        </h6>
                    <?php } ?>
                </div>
                <div class="text-end">
                    <a class="link-offset-2 link-underline link-underline-opacity-0" href="<?= SITE_ADDRESS ?>posts/index?sid=<?= $item['id'] ?>">
                        <button type="button" class="btn btn-primary">Ver <i class="icon icon-eye icon-16 icon-white"></i></button>
                    </a>
                    <?php if ($sessionOk && $item['userId'] == $userSession) { ?>
                        <a class="link-offset-2 link-underline link-underline-opacity-0" href="<?= SITE_ADDRESS ?>posts/edit?sid=<?= $item['id'] ?>">
                            <button type="button" class="btn btn-dark">Editar <i class="icon icon-edit icon-16 icon-white"></i></button>
                        </a>
                        <button type="button" id="btn_delete" data-sid="<?= $item['id'] ?>" class="btn btn-danger">Excluir <i class="icon icon-trash icon-16 icon-white"></i></button>
                    <?php } ?>
                </div>
                <br>
                <br>
                <hr>
            <?php } ?>
            <nav>
                <br>
                <ul class="pagination justify-content-center">
                    <?php if ($posts['currentPage'] > 1) { ?>
                        <li class="page-item">
                            <a class="page-link no-radius text-black" href="?page=<?= $posts['currentPage'] - 1 ?>" aria-label="Anterior">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php for ($i = 1; $i <= $posts['lastPage']; $i++) { ?>
                        <li class="page-item <?= $i == $posts['currentPage'] ? 'active' : '' ?>">
                            <a class="page-link no-radius <?= $i == $posts['currentPage'] ? 'background-red white-border-color text-white' : 'text-black' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php } ?>

                    <?php if ($posts['currentPage'] < $posts['lastPage']) { ?>
                        <li class="page-item">
                            <a class="page-link no-radius text-black" href="?page=<?= $posts['currentPage'] + 1 ?>" aria-label="Próximo">
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
<script type="text/javascript">
    $(document).ready(function() {

        async function deletePost(sid) {
            const url = `${SITE_ADDRESS}posts/api/delete?sid=${sid}`;
            try {
                const result = await $.ajax({
                    type: "POST",
                    url: url,
                    data: {},
                    cache: false,
                    async: true,
                    processData: false,
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    dataType: "json"
                });
                return result;
            } catch (error) {
                console.error('Erro na requisição:', error);
                return null;
            }
        }

        $('#btn_delete').click(async function() {
            const sid = $(this).data('sid');
            const urlReturn = `${SITE_ADDRESS}posts/myposts`;

            const result = await deletePost(sid);
            if (result && !result.error) {
                alert('Sua publicação foi excluída!');
                window.location = urlReturn;
            } else {
                alert('Houve um problema ao excluir a publicação.');
            }
        });

    });
</script>

</html>