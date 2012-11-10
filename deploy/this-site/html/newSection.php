<?php

require_once(THIS_SITE . 'html/error.php');
require_once(THIS_SITE . 'html/sectionInputs.php');

function newSection($formData, $error = '') {
    return sprintf('%s<form action="%s" method="post">%s'
        . '<input type="submit" value="Create New Section"/></form>',
        error($error), NEW_SECTION, sectionInputs($formData));
}

?>
