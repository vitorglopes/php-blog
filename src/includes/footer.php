<?php

namespace src\views\includes;

?>
<footer>
    <p class="roboto-bold">&copy; The Boring Blog, <?= date("Y") ?> - Todos os direitos reservados.</p>
</footer>
<script type="text/javascript" src="<?= SITE_PUBLIC ?>js/libs/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?= SITE_PUBLIC ?>js/libs/select2.full.min.js"></script>
<script type="text/javascript">
    const SITE_ADDRESS = "<?= SITE_ADDRESS ?>";
</script>