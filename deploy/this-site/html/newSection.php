<?php

require_once(CITYPHP . 'html/error.php');
require_once(THIS_SITE . 'html/sectionInputs.php');

function newSection($formData, $error = '') {
    ob_start(); ?>

<form method="post">
    <?=error($error)?>
    <?=sectionInputs($formData)?>
    <input type="submit" value="Create New Section"/>
</form>

    <? return ob_get_clean();
}

?>
