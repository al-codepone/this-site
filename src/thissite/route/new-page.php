<?php

$validator = new thissite\validator\PageValidator();

if(list($form_data, $errors) = $validator->validate()) {
    if($errors) {
        $t_content = new_page($form_data, $errors);
    }
    else {
        $t_content = is_int($result = $page_model->create($form_data))
            ? new_page_created($result, $form_data['url_id'])
            : new_page($form_data, $result);
    }
}
else {
    $form_data = $validator->values();
    $form_data['link_order'] = $page_model->getMaxLinkOrder() + 1;
    $t_content = new_page($form_data);
    $t_last = c\focus('link_title');
}

$is_new_page = true;
$t_head = c\title(c\esc(NEW_PAGE_TITLE));
