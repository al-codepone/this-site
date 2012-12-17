<?php

require_once(CITYPHP . 'html/error.php');
require_once(THIS_SITE . 'html/pageInputs.php');

function editPage($formData, $currentPage, $error = '') {
    ob_start(); ?>

<form method="post" id="page_form">
    <input type="hidden" name="delete_flag" value="0"/>
    <?=error($error)?>
    <?=pageInputs($formData)?>
    <div>
        <input type="submit" value="Save"
        /><input type="button" value="Delete" onClick="deletePage();"/>
    </div>
    <div><a href="<?=ROOT.$currentPage['url_id']?>">View Page</a></div>
</form>

    <?php return ob_get_clean();
}

?>
