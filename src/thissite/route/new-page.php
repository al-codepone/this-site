<?php

$validator = new thissite\validator\PageValidator();

if(list($formData, $errors) = $validator->validate()) {
    if($errors) {
        $t_content = new_page($formData, $errors);
    }
    else {
        $t_content = is_int($result = $page_model->create($formData))
            ? new_page_created($result, $formData['url_id'])
            : new_page($formData, $result);
    }
}
else {
    $formData = $validator->values();
    $formData['link_order'] = $page_model->getMaxLinkOrder() + 1;
    $t_content = new_page($formData);
    $t_last = c\focus('link_title');
}

$isNewPage = true;
$t_head = c\title(c\esc(NEW_PAGE_TITLE));
