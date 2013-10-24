<?php

require_once CITYPHP . 'html/blist.php';
require_once THISSITE . 'html/pageInputs.php';

function newPage($formData, $errors = array()) {
    ob_start(); ?>

<form method="post">
    <?=blist($errors, array('class' => 'error'))?>
    <?=pageInputs($formData)?>
    <div><input type="submit" value="Create New Page"/></div>
</form>

    <? return ob_get_clean();
}

?>
