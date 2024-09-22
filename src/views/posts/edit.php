<?php

namespace src\views;

$post = $data['data'];
$sid = $data['sid'];
$categories = $data['categories'];

?>

<!DOCTYPE html>
<html>

<head>
    <?php require 'src/includes/head.php'; ?>
</head>

<body>
    <?php require 'src/includes/header.php'; ?>
    <div class="container" id="page-container">
        <div class="row mt-4">
            <form id="form-post" action="<?= SITE_ADDRESS ?>posts/edit?sid=<?= $sid ?>" method="post">
                <input type="hidden" id="sid" name="sid" value="<?= $sid ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Título: </label>
                            <input type="text" class="form-control no-radius" id="title" name="title" value="<?= $post->title ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="subtitle">Subtítulo: </label>
                            <input type="text" class="form-control no-radius" id="subtitle" name="subtitle" value="<?= $post->subtitle ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label for="category">Assunto: </label>
                            <select id="category" name="category" class="form-control no-radius">
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?= $category->id ?>" <?= $post->category_id == $category->id ? 'selected' : '' ?>><?= $category->description ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status: </label>
                            <select id="status" name="status" class="form-control no-radius">
                                <option value="draft" <?= $post->status == 'draft' ? 'selected' : '' ?>> Rascunho </option>
                                <option value="hidden" <?= $post->status == 'hidden' ? 'selected' : '' ?>> Privado </option>
                                <option value="ok" <?= $post->status == 'ok' ? 'selected' : '' ?>> Publicado </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="content">Conteúdo: </label>
                            <textarea id="content" name="content" class="form-control" style="height: 400px;" required><?= $post->content ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="text-end">
                        <br>
                        <button type="button" id="btn_save" class="btn btn-success text-white text-end">Salvar <i class="icon icon-save icon-white icon-24"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php require 'src/includes/footer.php'; ?>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        const sid = "<?= $sid ?>";

        async function savePost(sid, data) {
            const url = `${SITE_ADDRESS}posts/api/save?sid=${sid}`;
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

        $('#btn_save').click(async function() {
            const urlReturn = `${SITE_ADDRESS}posts/myposts`;
            const title = $('#title').val();
            const subtitle = $('#subtitle').val();
            const content = $('#content').val();
            const category = $('#category').val();
            const status = $('#status').val();

            const result = await savePost(sid, $.param({
                title: title,
                subtitle: subtitle,
                content: content,
                category: category,
                status: status
            }));

            if (result && !result.error) {
                alert('Publicado com sucesso!');
                window.location = urlReturn;
            } else {
                alert('Houve um problema ao salvar a publicação.');
            }
        });
    });
</script>

</html>