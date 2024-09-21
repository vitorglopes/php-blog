<?php

namespace src\views;

$returnToPage = $data['returnToPage'];
$error = $data['error'] ?? "";

?>
<!DOCTYPE html>
<html>

<head>
    <?php require 'src/includes/head.php'; ?>
</head>

<body class="background-gray">
    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
        <div class="row w-100 justify-content-center">
            <img width="400" height="200" src="<?= SITE_PUBLIC_IMG ?>login.svg" alt="Login">
            <div class="col-lg-4 col-md-6 col-sm-8">

                <div class="card shadow-sm">
                    <div class="card-body no radius">
                        <h3 class="card-title text-center roboto-black">THE BORING BLOG <i class="icon icon-monitor icon-black icon-32"></i></h3>
                        <h4 class="card-title text-center roboto-regular">Entre para continuar</h4>
                        <hr>
                        <form action="<?= SITE_ADDRESS ?>login/auth" method="post">
                            <input type="hidden" id="returnToPage" name="returnToPage" value="<?= $returnToPage ?>">
                            <div class="form-group">
                                <label for="email"> Email: </label>
                                <input type="email" id="email" name="email" class="form-control no-radius" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="passwd">Senha: </label>
                                <input type="password" id="passwd" name="passwd" class="form-control no-radius" value="" required>
                            </div>
                            <br>
                            <div class="form-group d-flex justify-content-between">
                                <a href="#">Cadastrar-se</a>
                                <a href="#">Esqueceu a senha?</a>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-block no-radius background-red text-white">Entrar</button>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'src/includes/footer.php'; ?>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        const errorAuth = "<?= $error ?>";

        if (errorAuth != "") {
            alert(errorAuth);
        }
    });
</script>

</html>