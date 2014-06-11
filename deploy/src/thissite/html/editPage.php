<?php

function editPage(array $formData, $currentPage, $errors = array()) {
    return
    c\form(
        array('method' => 'post', 'id' => 'page_form'),
        '<input type="hidden" name="delete_flag" value="0"/>',
        c\ulist($errors, array('class' => 'error')),
        c\div(c\hlink(
            ROOT . $currentPage['url_id'],
            'View Page')),

        pageInputs($formData),
        c\div(
            '<input type="submit" value="Save"/>',
            '<input type="button" value="Delete" onclick="deletePage();"/>'));
}

?>
