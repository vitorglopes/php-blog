<?php

namespace src\views\posts;

use src\core\Util;

$userSession = isset($_SESSION['userId']) ? $_SESSION['userId'] : 0;
$post = $data['post'];
$sid = $data['sid'];
$comments = $data['comments'];

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
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <?php if ($sessionOk && $post->user_id == $userSession) { ?>
                    <div class="text-end">
                        <a class="link-offset-2 link-underline link-underline-opacity-0" href="<?= SITE_ADDRESS ?>posts/edit?sid=<?= Util::secureValue($post->id) ?>">
                            <button type="button" class="btn btn-dark">Editar <i class="icon icon-edit icon-16 icon-white"></i></button>
                        </a>
                    </div>
                <?php } ?>
                <span class="badge bg-info text-start"><?= $post->category_description ?></span>
                <input type="hidden" id="sid" name="sid" value="<?= $sid ?>">
                <h3 class="roboto-black"><?= $post->title ?></h3>
                <p class="text-body-secondary text-start"><?= $post->subtitle ?></p>
                <p class="text-start"><?= $post->content ?></p>
                <p class="text-end">Postado por <strong><?= "$post->first_name $post->last_name" ?></strong> em <strong><?= Util::dateFromDb($post->registered_at) ?></strong></p>
                <br>
                <hr>
                <h5 class="roboto-black text-red">Comentários</h5>
                <?php if ($sessionOk) { ?>
                    <div class="form-group">
                        <textarea id="comment" name="comment" class="form-control" style="height: 100px;" placeholder="Escreva seu comentário"></textarea>
                    </div>
                    <br>
                    <div class="text-end">
                        <button type="button" id="btn-new-comment" class="btn background-red text-white no-radius">Enviar comentário</button>
                    </div>
                    <br>
                <?php } else { ?>
                    <a class="link-offset-2 link-underline link-underline-opacity-0" href="<?= SITE_ADDRESS ?>login/index">
                        <button type="button" id="btn-login-to-comment" class="btn background-red text-white no-radius">Faça login para comentar <i class="icon icon-log-in icon-24 icon-white"></i></button>
                    </a>
                <?php } ?>
                <hr>
                <?php foreach ($comments as $comment) { ?>
                    <p class="text-start">
                        <i class="icon icon-eye icon-user icon-black icon-24"></i>
                        <strong><?= "$comment->firstName $comment->lastName - " . Util::dateFromDb($comment->registered_at) ?>:</strong> <?= $comment->content ?>
                    </p>
                <?php } ?>
                <br>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
    <?php require 'src/includes/footer.php'; ?>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        const sid = "<?= $sid ?>";
        const userSession = "<?= $userSession ?>";

        async function saveComment(data) {
            const url = `${SITE_ADDRESS}posts/api/new-comment`;
            try {
                const result = await $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
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

        $('#btn-new-comment').click(async function() {
            const sid = $('#sid').val();
            const urlReturn = `${SITE_ADDRESS}posts/index?sid=${sid}#comment`;
            const refCommentId = 0;
            const userId = userSession;
            const content = $('#comment').val();

            const result = await saveComment($.param({
                postId: sid,
                refCommentId: refCommentId,
                userId: userId,
                content: content
            }));

            if (result && !result.error) {
                window.location = urlReturn;
            } else {
                alert('Houve um problema ao salvar o comentário.');
            }
        });
    });
</script>

</html>