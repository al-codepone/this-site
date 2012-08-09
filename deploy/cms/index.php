<?php

require_once('../constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(THIS_SITE_PHP . 'database/MyModelFactory.php');
require_once(THIS_SITE_PHP . 'database/SectionData.php');
require_once(THIS_SITE_PHP . 'forms/NewSectionFormHandler.php');
require_once(THIS_SITE_PHP . 'html/forms/NewSectionFormView.php');
require_once(THIS_SITE_PHP . 'html/Message.php');
require_once(THIS_SITE_PHP . 'html/navigation/CmsNavigation.php');
require_once(THIS_SITE_PHP . 'html/ThisSiteHtmlBody.php');
require_once(THIS_SITE_PHP . 'html/ThisSiteHtmlHead.php');

$sectionModel = MyModelFactory::getModel('SectionModel');
$formHandler = new NewSectionFormHandler();
$view = null;
$isAutofocus = false;

if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $formSectionData = $formHandler->getSectionData();

    if(count($errors) > 0) {
        $view = new NewSectionFormView($formSectionData, current($errors));
    }
    else {
        $duplicateCheck = $sectionModel->getSectionWithUID($formSectionData->url_id);

        if($duplicateCheck->section_id != -1) {
            $view = new NewSectionFormView($formSectionData, 'URL ID already in use');
        }
        else {
            $newSectionID = $sectionModel->addSection($formSectionData);
            $view = new Message('<div class="success">New section created</div>'
                . sprintf('<ul><li><a href="%s%s">View Section</a></li>', ROOT, $formSectionData->url_id)
                . sprintf('<li><a href="%s?sid=%d">Edit Section</a></li>', EDIT_SECTION, $newSectionID)
                . sprintf('<li><a href="%s">New Section</a></li></ul>', NEW_SECTION));
        }
    }
}
else {
    $formSectionData = new SectionData();
    $formSectionData->link_order = $sectionModel->getMaxLinkOrder() + 1;
    $view = new NewSectionFormView($formSectionData);
    $isAutofocus = true;
}

$navigation = new CmsNavigation($sectionModel->getSections());
$htmlHead = new ThisSiteHtmlHead(array('<title>Create New Section</title>'));
$htmlBody = new ThisSiteHtmlBody($navigation, $view, $isAutofocus);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
