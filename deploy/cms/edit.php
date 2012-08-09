<?php

//
require_once('../constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(THIS_SITE_PHP . 'database/MyModelFactory.php');
require_once(THIS_SITE_PHP . 'forms/EditSectionFormHandler.php');
require_once(THIS_SITE_PHP . 'html/forms/EditSectionFormView.php');
require_once(THIS_SITE_PHP . 'html/Message.php');
require_once(THIS_SITE_PHP . 'html/navigation/CmsNavigation.php');
require_once(THIS_SITE_PHP . 'html/ThisSiteHtmlBody.php');
require_once(THIS_SITE_PHP . 'html/ThisSiteHtmlHead.php');

//
$sectionID = intval($_GET['sid']);
$sectionModel = MyModelFactory::getModel('SectionModel');
$currentSection = $sectionModel->getSectionWithSID($sectionID);
$view = null;

if($currentSection->section_id != -1) {
    $formHandler = new EditSectionFormHandler();

    if($formHandler->isReady()) {
        $errors = $formHandler->validate();
        $formSectionData = $formHandler->getSectionData();
        $deleteFlag = intval($formHandler->getValue('x7n'));

        if($deleteFlag == 1459) {
            $sectionModel->deleteSection($sectionID);
            $view = new Message('<div class="success">Section deleted</div>');
        }
        else if(count($errors) > 0) {
            $view = new EditSectionFormView($formSectionData, current($errors), $currentSection);
        }
        else {
            $duplicateCheck = $sectionModel->getSectionWithUID($formSectionData->url_id);

            if($duplicateCheck->section_id != -1 && $duplicateCheck->section_id != $currentSection->section_id) {
                $view = new EditSectionFormView($formSectionData, 'URL ID already in use', $currentSection);
            }
            else {
                $formSectionData->section_id = $sectionID;
                $sectionModel->editSection($formSectionData);
                $view = new Message('<div class="success">Section updated</div>'
                    . sprintf('<ul><li><a href="%s%s">View Section</a></li>', ROOT, $formSectionData->url_id)
                    . sprintf('<li><a href="%s?sid=%d">Edit Section</a></li></ul>', EDIT_SECTION, $sectionID));
            }
        }
    }
    else {
        $view = new EditSectionFormView($currentSection, '', $currentSection);
    }
}
else {
   $view = new Message('This section is invalid.');
}

$headTags = array('<title>Edit Section</title>',
    '<script src="' . JAVASCRIPT . 'editSection.js"></script>');

//
$navigation = new CmsNavigation($sectionModel->getSections(), $currentSection, false);
$htmlHead = new ThisSiteHtmlHead($headTags);
$htmlBody = new ThisSiteHtmlBody($navigation, $view);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
