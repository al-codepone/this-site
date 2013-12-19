<?php

require_once CITYPHP . 'html/blist.php';
require_once CITYPHP . 'html/input.php';
require_once THISSITE . 'html/pageInputs.php';

function newPage(array $formData, $errors = array()) {
    return
        '<form method="post">'
        . blist($errors, array('class' => 'error'))
        . pageInputs($formData)
        . input(array(
            'type' => 'submit',
            'value' => 'Create New Page'))

        . '</form>';
}

?>
