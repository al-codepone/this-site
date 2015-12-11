<?php

$page_id = $_GET['id'];
$page = $page_model->getWithPID($page_id);

if($page) {
    $validator = new thissite\validator\EditPageValidator();

    if(list($form_data, $errors) = $validator->validate()) {
        if($form_data['delete_flag']) {
            $page_model->delete($page_id);
            $t_content = '<div class="success">Page deleted</div>';
        }
        else if($errors) {
            $t_content = edit_page($form_data, $page, $errors);
        }
        else {
            $t_content = ($error = $page_model->update($page_id, $form_data))
                ? edit_page($form_data, $page, $error)
                : page_updated($page_id, $form_data['url_id']);
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
