<?php

require_once(THISSITE . 'html/editPage.php');
require_once(THISSITE . 'html/pageUpdated.php');

use thissite\forms\EditPageValidator;

$pageID = $_GET['id'];
$page = $pageModel->getPageWithPID($pageID);

if($page) {
    $validator = new EditPageValidator();

    if(list($formData, $errors) = $validator->validate()) {
        if($errors) {
            $content = editPage($formData, $page, current($errors));
        }
        else if($formData['delete_flag']) {
            $pageModel->deletePage($pageID);
            $content = '<div class="success">Page deleted</div>';
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
}
else {
   $content = 'This page is invalid.';
}

$head = '<script src="' . JS . 'edit-page.js"></script>';

?>
