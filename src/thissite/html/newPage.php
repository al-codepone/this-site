<?php

function newPage(array $formData, $errors = array()) {
    return c\form(
        array('method' => 'post'),
        c\ulist($errors, array('class' => 'error')),
        pageInputs($formData),
        c\div('<input type="submit" value="Create New Page"/>'));
}
