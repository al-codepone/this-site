<?php

$validator = new thissite\validator\PageValidator();

if(list($formData, $errors) = $validator->validate()) {
    if($errors) {
        $t_content = newPage($formData, $errors);
    }
    else {
        $t_content = is_int($result = $pageModel->create($formData))
            ? newPageCreated($result, $formData['url_id'])
            : newPage($formData, $result);
    }
}
else {
    $formData = $validator->values();
    $formData['link_order'] = $pageModel->getMaxLinkOrder() + 1;
    $t_content = newPage($formData);
    $t_autofocus = c\focus('link_title');
}

$isNewPage = true;
$t_head = c\title(c\esc(NEW_PAGE_TITLE));
