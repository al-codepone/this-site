<?php

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
