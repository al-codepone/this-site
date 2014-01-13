<?php

require_once THISSITE . 'html/editPage.php';
require_once THISSITE . 'html/pageUpdated.php';

use thissite\forms\EditPageValidator;

$pageID = $_GET['id'];
$page = $pageModel->getPageWithPID($pageID);

if($page) {
    $validator = new EditPageValidator();

    if(list($formData, $errors) = $validator->validate()) {
        if($formData['delete_flag']) {
            $pageModel->deletePage($pageID);
            $content = '<div class="success">Page deleted</div>';
        }
        else if($errors) {
            $content = editPage($formData, $page, $errors);
        }
        else {
            $content = ($error = $pageModel->updatePage($pageID, $formData))
                ? editPage($formData, $page, $error)
                : pageUpdated($pageID, $formData['url_id']);
        }
    }
    else {
        $content = editPage($page, $page);
    }

    $head = sprintf('<title>Edit Page #%d</title>', $page['page_id']);
}
else {
    header('HTTP/1.0 404 Not Found', true, 404);
    exit();
}

?>