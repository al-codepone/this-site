<?php

require_once CITYPHP . 'html/ulist.php';
require_once THISSITE . 'html/pageInputs.php';

function editPage($formData, $currentPage, $errors = array()) {
    ob_start(); ?>

<form method="post" id="page_form">
    <input type="hidden" name="delete_flag" value="0"/>
    <?=ulist($errors, array('class' => 'error'))?>
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
