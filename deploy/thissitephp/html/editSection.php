<?php

require_once(THIS_SITE_PHP . 'html/error.php');
require_once(THIS_SITE_PHP . 'html/sectionInputs.php');

function editSection($formData, $currentSection, $error = '') {
    ob_start(); 
    print error($error); ?>

<form action="<?=EDIT_SECTION?>?sid=<?=$currentSection['section_id']?>" method="post" id="section_form">
    <input type="hidden" name="delete_flag" value="0"/><?=sectionInputs($formData)?>
    <div><input type="submit" value="Save"/> <input type="button" value="Delete" onClick="deleteSection();"/></div>
    <div><a href="<?=ROOT.$currentSection['url_id']?>">View Section</a></div>
</form>

    <?php return ob_get_clean();
}

?>
