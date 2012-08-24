<?php

require_once(THIS_SITE_PHP . 'forms/SectionFormHandler.php');
require_once(THIS_SITE_PHP . 'html/newSection.php');

$formHandler = new SectionFormHandler();
$isNewSection = true;

if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $formData = $formHandler->getValues();

    if(count($errors) > 0) {
        $content = newSection($formData, current($errors));
    }
    else {
        $duplicateCheck = $sectionModel->getSectionWithUID($formData['url_id']);

        if($duplicateCheck) {
            $content = newSection($formData, urlDupError($formData['url_id']));
        }
        else {
            $newSectionID = $sectionModel->addSection($formData);
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
    $formData = $formHandler->getValues();
    $formData['link_order'] = $sectionModel->getMaxLinkOrder() + 1;
    $content = newSection($formData);
    $autofocus = '<script>document.getElementById("link_title").focus();</script>';
}

?>
