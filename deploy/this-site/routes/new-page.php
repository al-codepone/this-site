<?php

require_once(CITYPHP . 'html/autofocus.php');
require_once(THIS_SITE . 'forms/PageValidator.php');
require_once(THIS_SITE . 'html/newPage.php');
require_once(THIS_SITE . 'html/newPageCreated.php');

$validator = new PageValidator();

if(list($formData, $errors) = $validator->validate()) {
    if($errors) {
        $content = newPage($formData, current($errors));
    }
    else {
        $content = is_int($result = $pageModel->createPage($formData))
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

?>
