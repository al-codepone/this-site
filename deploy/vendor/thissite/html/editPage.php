<?php

require_once CITYPHP . 'html/blist.php';
require_once THISSITE . 'html/pageInputs.php';

function editPage($formData, $currentPage, $errors = array()) {
    ob_start(); ?>

<form method="post" id="page_form">
    <input type="hidden" name="delete_flag" value="0"/>
    <?=blist($errors, array('class' => 'error'))?>
    <div><a href="<?=ROOT . $currentPage['url_id']?>">View Page</a></div>
    <?=pageInputs($formData)?>
    <div>
        <input type="submit" value="Save"
        /><input type="button" value="Delete" onClick="deletePage();"/>
    </div>
</form>

    <?php return ob_get_clean();
}

?>
