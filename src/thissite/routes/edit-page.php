<?php

$pageID = $_GET['id'];
$page = $pageModel->getWithPID($pageID);

if($page) {
    $validator = new thissite\forms\EditPageValidator();

    if(list($formData, $errors) = $validator->validate()) {
        if($formData['delete_flag']) {
            $pageModel->delete($pageID);
            $content = '<div class="success">Page deleted</div>';
        }
        else if($errors) {
            $content = editPage($formData, $page, $errors);
        }
        else {
            $content = ($error = $pageModel->update($pageID, $formData))
                ? editPage($formData, $page, $error)
                : pageUpdated($pageID, $formData['url_id']);
        }
    }
    else {
        $content = editPage($page, $page);
    }

    $head = c\title('Edit Page #' . $page['page_id']);
}
else {
    header('HTTP/1.0 404 Not Found', true, 404);
    exit();
}
