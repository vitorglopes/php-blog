<?php

namespace src\view\home;

$search = $data['search'] ?? "";

?>

<!DOCTYPE html>
<html>

<head>
    <?php require 'src/includes/head.php'; ?>
</head>

<body>
    <div class="content">
        <?php require 'src/includes/header.php'; ?>
        <div class="containter-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Exibindo resultados para &#34;<strong><?= $search ?></strong>&#34;</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                teste
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'src/includes/footer.php'; ?>
</body>

</html>