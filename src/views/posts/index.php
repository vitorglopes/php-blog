<?php

namespace src\views\posts;

use src\core\Util;

$userSession = isset($_SESSION['userId']) ? $_SESSION['userId'] : 0;
$post = $data['post'];

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
                <?php if ($sessionOk && $post->user_id == $userSession) { ?>
                    <div class="text-end">
                        <a class="link-offset-2 link-underline link-underline-opacity-0" href="<?= SITE_ADDRESS ?>posts/edit?sid=<?= Util::secureValue($post->id) ?>">
                            <button type="button" class="btn btn-dark">Editar <i class="icon icon-edit icon-16 icon-white"></i></button>
                        </a>
                    </div>
                <?php } ?>
                <span class="badge bg-info text-start"><?= $post->category_description ?></span>
                <h3 class="roboto-black"><?= $post->title ?></h3>
                <p class="text-body-secondary text-start"><?= $post->subtitle ?></p>
                <p class="text-start"><?= $post->content ?></p>
                <p class="text-end">Postado por <strong><?= "$post->first_name $post->last_name" ?></strong> em <strong><?= Util::dateFromDb($post->registered_at) ?></strong></p>
            </div>
        </div>
    </div>
    <?php require 'src/includes/footer.php'; ?>
</body>
<script type="text/javascript">
    $(document).ready(function() {

    });
</script>

</html>