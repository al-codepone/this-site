<?php

require_once('../constants.php');
require_once(THIS_SITE_PHP . 'database/MyModelFactory.php');
require_once(THIS_SITE_PHP . 'forms/NewSectionFormHandler.php');
require_once(THIS_SITE_PHP . 'html/cmsNavItems.php');
require_once(THIS_SITE_PHP . 'html/newSection.php');

$sectionModel = MyModelFactory::getModel('SectionModel');
$formHandler = new NewSectionFormHandler();

if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $formData = $formHandler->getValues();

    if(count($errors) > 0) {
        $content = newSection($formData, current($errors));
    }
    else {
        $duplicateCheck = $sectionModel->getSectionWithUID($formData['url_id']);

        if($duplicateCheck) {
            $content = newSection($formData, 'URL ID already in use');
        }
        else {
            $newSectionID = $sectionModel->addSection($formData);
            $content = sprintf('<div class="success">New section created</div>'
                . '<ul><li><a href="%s%s">View Section</a></li>'
                . '<li><a href="%s?sid=%d">Edit Section</a></li>'
                . '<li><a href="%s">New Section</a></li></ul>',
                ROOT, $formData['url_id'], EDIT_SECTION, $newSectionID, NEW_SECTION);
        }
    }
}
else {
    $formData = $formHandler->getValues();
    $formData['link_order'] = $sectionModel->getMaxLinkOrder() + 1;
    $content = newSection($formData);
}

$navItems = cmsNavItems($sectionModel->getSections());
include(THIS_SITE_PHP . 'html/template.php');

?>
