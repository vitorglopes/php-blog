<?php

namespace src\views\includes;

?>
<footer>
    <p class="roboto-bold">&copy; The Boring Blog, <?= date("Y") ?> - Todos os direitos reservados.</p>
</footer>
<script type="text/javascript" src="<?= SITE_PUBLIC ?>js/libs/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="<?= SITE_PUBLIC ?>js/libs/bootstrap-5.3.3.bundle.min.js"></script>
<script type="text/javascript" src="<?= SITE_PUBLIC ?>js/libs/select2.full.min.js"></script>
<script type="text/javascript">
    const SITE_ADDRESS = "<?= SITE_ADDRESS ?>";
    const SITE_PUBLIC = "<?= SITE_PUBLIC ?>";
</script>