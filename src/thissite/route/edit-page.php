<?php

$pageID = $_GET['id'];
$page = $page_model->getWithPID($pageID);

if($page) {
    $validator = new thissite\validator\EditPageValidator();

    if(list($formData, $errors) = $validator->validate()) {
        if($formData['delete_flag']) {
            $page_model->delete($pageID);
            $t_content = '<div class="success">Page deleted</div>';
        }
        else if($errors) {
            $t_content = edit_page($formData, $page, $errors);
        }
        else {
            $t_content = ($error = $page_model->update($pageID, $formData))
                ? edit_page($formData, $page, $error)
                : page_updated($pageID, $formData['url_id']);
        }
    }
    else {
        $t_content = edit_page($page, $page);
    }

    $t_head = c\title('Edit Page #' . $page['page_id']);
}
else {
    header('HTTP/1.0 404 Not Found', true, 404);
    exit();
}
