<?php

require_once(CITYPHP . 'html/error.php');
require_once(THIS_SITE . 'html/pageInputs.php');

function newPage($formData, $error = '') {
    ob_start(); ?>

<form method="post">
    <?=error($error)?>
    <?=pageInputs($formData)?>
    <input type="submit" value="Create New Page"/>
</form>

    <? return ob_get_clean();
}

?>
