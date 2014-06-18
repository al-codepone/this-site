<?php

$validator = new thissite\forms\PageValidator();

if(list($formData, $errors) = $validator->validate()) {
    if($errors) {
        $content = newPage($formData, $errors);
    }
    else {
        $content = is_int($result = $pageModel->create($formData))
            ? newPageCreated($result, $formData['url_id'])
            : newPage($formData, $result);
    }
}
else {
    $formData = $validator->values();
    $formData['link_order'] = $pageModel->getMaxLinkOrder() + 1;
    $content = newPage($formData);
    $autofocus = autofocus('link_title');
}

$isNewPage = true;
$head = c\title(c\esc(NEW_PAGE_TITLE));
