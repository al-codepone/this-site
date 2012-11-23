<?php

require_once(CITYPHP . 'html/error.php');
require_once(THIS_SITE . 'html/sectionInputs.php');

function newSection($formData, $error = '') {
    return sprintf('<form method="post">%s%s'
        . '<input type="submit" value="Create New Section"/></form>',
        error($error), sectionInputs($formData));
}

?>
