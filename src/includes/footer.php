<?php

namespace src\views\includes;

?>
<footer class="bg-dark text-center py-3 mt-auto">
    <div class="container">
        <p class="roboto-bold">&copy; The Boring Blog, <?= date("Y") ?> - Todos os direitos reservados.</p>
    </div>
</footer>
<script type="text/javascript" src="<?= SITE_PUBLIC_JS ?>libs/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="<?= SITE_PUBLIC_JS ?>libs/bootstrap-5.3.3.bundle.min.js"></script>
<script type="text/javascript" src="<?= SITE_PUBLIC_JS ?>libs/bootstrap.bundle.min.js.map"></script>
<script type="text/javascript" src="<?= SITE_PUBLIC_JS ?>libs/select2.full.min.js"></script>
<script type="text/javascript" src="<?= SITE_PUBLIC_JS ?>index.js"></script>
<script type="text/javascript">
    const SITE_ADDRESS = "<?= SITE_ADDRESS ?>";
    const SITE_PUBLIC = "<?= SITE_PUBLIC ?>";
</script>