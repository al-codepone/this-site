<?php

require_once(STD_LIB . 'html/error.php');
require_once(THIS_SITE . 'html/sectionInputs.php');

function editSection($formData, $currentSection, $error = '') {
    ob_start(); ?>

<form method="post" id="section_form">
    <input type="hidden" name="delete_flag" value="0"/>
    <?=error($error)?>
    <?=sectionInputs($formData)?>
    <div><input type="submit" value="Save"/> <input type="button" value="Delete" onClick="deleteSection();"/></div>
    <div><a href="<?=ROOT.$currentSection['url_id']?>">View Section</a></div>
</form>

    <?php return ob_get_clean();
}

?>
