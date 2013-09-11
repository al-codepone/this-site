<?php

require_once CITYPHP . 'html/error.php';
require_once THISSITE . 'html/pageInputs.php';

function newPage($formData, $error = '') {
    ob_start(); ?>

<form method="post">
    <?=error($error)?>
    <?=pageInputs($formData)?>
    <div><input type="submit" value="Create New Page"/></div>
</form>

    <? return ob_get_clean();
}

?>
