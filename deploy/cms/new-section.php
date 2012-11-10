<?php

require_once(THIS_SITE . 'forms/SectionValidator.php');
require_once(THIS_SITE . 'html/newSection.php');

$validator = new SectionValidator();
$isNewSection = true;

if(list($formData, $errors) = $validator->validate()) {
    if(count($errors) > 0) {
        $content = newSection($formData, current($errors));
    }
    else {
        $duplicateCheck = $sectionModel->getSectionWithUID($formData['url_id']);

        if($duplicateCheck) {
            $content = newSection($formData, urlDupError($formData['url_id']));
        }
        else {
            $newSectionID = $sectionModel->createSection($formData);
            $content = sprintf('<div class="success">New section created</div>'
                . '<ul><li><a href="%s%s">View Section</a></li>'
                . '<li><a href="%s%d">Edit Section</a></li>'
                . '<li><a href="%s">%s</a></li></ul>',
                ROOT, $formData['url_id'], EDIT_SECTION,
                $newSectionID, NEW_SECTION, NEW_SECTION_TITLE);
        }
    }
}
else {
    $formData = $validator->values();
    $formData['link_order'] = $sectionModel->getMaxLinkOrder() + 1;
    $content = newSection($formData);
    $autofocus = '<script>document.getElementById("link_title").focus();</script>';
}

?>
