<?php

require_once(CITYPHP . 'html/autofocus.php');
require_once(THIS_SITE . 'forms/SectionValidator.php');
require_once(THIS_SITE . 'html/newSection.php');
require_once(THIS_SITE . 'html/newSectionCreated.php');

$validator = new SectionValidator();

if(list($formData, $errors) = $validator->validate()) {
    if($errors) {
        $content = newSection($formData, current($errors));
    }
    else {
        $content = is_int($result = $sectionModel->createSection($formData))
            ? newSectionCreated($result, $formData['url_id'])
            : newSection($formData, $result);
    }
}
else {
    $formData = $validator->values();
    $formData['link_order'] = $sectionModel->getMaxLinkOrder() + 1;
    $content = newSection($formData);
    $autofocus = autofocus('link_title');
}

$isNewSection = true;

?>
