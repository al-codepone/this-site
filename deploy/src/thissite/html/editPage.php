<?php

require_once CITYPHP . 'html/blist.php';
require_once THISSITE . 'html/pageInputs.php';

function editPage(array $formData, $currentPage, $errors = array()) {
    return
        '<form method="post" id="page_form">
        <input type="hidden" name="delete_flag" value="0"/>'
        . blist($errors, array('class' => 'error'))
        . sprintf('<div><a href="%s%s">View Page</a></div>',
            ROOT,
            $currentPage['url_id'])

        . pageInputs($formData)
        . sprintf('<div>%s%s</div>',
            '<input type="submit" value="Save"/>',
            '<input type="button" value="Delete" onclick="deletePage();"/>')

        . '</form>';
}

?>
