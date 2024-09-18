<?php

namespace src\views\posts;

$post = $data['post'];

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
                <h3 class="roboto-black"><?= $post['title'] ?></h3>
                <p class="text-body-secondary"><?= $post['subtitle'] ?></p>
                <p><?= $post['content'] ?></p>
            </div>
        </div>
    </div>
    <?php require 'src/includes/footer.php'; ?>
</body>

</html>