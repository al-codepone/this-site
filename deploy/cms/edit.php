<?php

//
require_once('../constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(THIS_SITE_PHP . 'database/DatabaseApi.php');
require_once(THIS_SITE_PHP . 'forms/EditSectionFormHandler.php');
require_once(THIS_SITE_PHP . 'html/DefaultThisSiteHtmlBody.php');
require_once(THIS_SITE_PHP . 'html/forms/EditDefaultSectionFormView.php');
require_once(THIS_SITE_PHP . 'html/misc/Message.php');
require_once(THIS_SITE_PHP . 'html/navigation/DefaultCmsNavigation.php');
require_once(THIS_SITE_PHP . 'html/ThisSiteHtmlHead.php');

//
$sectionID = intval($_GET['sid']);
$databaseApi = new DatabaseApi();
$currentSection = $databaseApi->getSectionWithSID($sectionID);
$view = null;

if($currentSection->section_id != -1) {
    $formHandler = new EditSectionFormHandler();

    if($formHandler->isReady()) {
        $errors = $formHandler->validate();
        $formSectionData = $formHandler->getSectionData();
        $deleteFlag = intval($formHandler->getValue('x7n'));

        if($deleteFlag == 1459) {
            $databaseApi->deleteSection($sectionID);
            $view = new Message('<div class="success">Section deleted</div>');
        }
        else if(count($errors) > 0) {
            $view = new EditDefaultSectionFormView($formSectionData, current($errors), $currentSection);
        }
        else {
            $duplicateCheck = $databaseApi->getSectionWithUID($formSectionData->url_id);

            if($duplicateCheck->section_id != -1 && $duplicateCheck->section_id != $currentSection->section_id) {
                $view = new EditDefaultSectionFormView($formSectionData, 'URL ID already in use', $currentSection);
            }
            else {
                $formSectionData->section_id = $sectionID;
                $databaseApi->editSection($formSectionData);
                $view = new Message('<div class="success">Section updated</div>'
                    . sprintf('<ul><li><a href="%s%s">View Section</a></li>', ROOT, $formSectionData->url_id)
                    . sprintf('<li><a href="%s?sid=%d">Edit Section</a></li></ul>', EDIT_SECTION, $sectionID));
            }
        }
    }
    else {
        $view = new EditDefaultSectionFormView($currentSection, '', $currentSection);
    }
}
else {
   $view = new Message('This section is invalid.');
}

$headTags = array('<title>Edit Section</title>',
    '<script type="text/javascript" src="' . JAVASCRIPT . 'editSection.js"></script>');

//
$navigation = new DefaultCmsNavigation($databaseApi->getSections(), $currentSection, false);
$htmlHead = new ThisSiteHtmlHead($headTags);
$htmlBody = new DefaultThisSiteHtmlBody($navigation, $view);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
