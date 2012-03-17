<?php

//
require_once('../constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(THIS_SITE_PHP . 'database/DatabaseApi.php');
require_once(THIS_SITE_PHP . 'database/SectionData.php');
require_once(THIS_SITE_PHP . 'forms/NewSectionFormHandler.php');
require_once(THIS_SITE_PHP . 'html/DefaultThisSiteHtmlBody.php');
require_once(THIS_SITE_PHP . 'html/forms/NewDefaultSectionFormView.php');
require_once(THIS_SITE_PHP . 'html/misc/Message.php');
require_once(THIS_SITE_PHP . 'html/navigation/DefaultCmsNavigation.php');
require_once(THIS_SITE_PHP . 'html/ThisSiteHtmlHead.php');

//
$databaseApi = new DatabaseApi();
$formHandler = new NewSectionFormHandler();
$view = null;
$isAutofocus = false;

if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $formSectionData = $formHandler->getSectionData();

    if(count($errors) > 0) {
        $view = new NewDefaultSectionFormView($formSectionData, current($errors));
    }
    else {
        $duplicateCheck = $databaseApi->getSectionWithUID($formSectionData->url_id);

        if($duplicateCheck->section_id != -1) {
            $view = new NewDefaultSectionFormView($formSectionData, 'URL ID already in use');
        }
        else {
            $newSectionID = $databaseApi->addSection($formSectionData);
            $view = new Message('<div class="success">New section created</div>'
                . sprintf('<ul><li><a href="%s%s">View Section</a></li>', ROOT, $formSectionData->url_id)
                . sprintf('<li><a href="%s?sid=%d">Edit Section</a></li>', EDIT_SECTION, $newSectionID)
                . sprintf('<li><a href="%s">New Section</a></li></ul>', NEW_SECTION));
        }
    }
}
else {
    $formSectionData = new SectionData();
    $formSectionData->link_order = $databaseApi->getMaxLinkOrder() + 1;
    $view = new NewDefaultSectionFormView($formSectionData);
    $isAutofocus = true;
}


$navigation = new DefaultCmsNavigation($databaseApi->getSections());
$htmlHead = new ThisSiteHtmlHead(array('<title>Create New Section</title>'));
$htmlBody = new DefaultThisSiteHtmlBody($navigation, $view, $isAutofocus);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
