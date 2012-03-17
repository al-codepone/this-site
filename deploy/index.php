<?php

//
require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(THIS_SITE_PHP . 'database/DatabaseApi.php');
require_once(THIS_SITE_PHP . 'html/DefaultThisSiteHtmlBody.php');
require_once(THIS_SITE_PHP . 'html/misc/Message.php');
require_once(THIS_SITE_PHP . 'html/navigation/DefaultNavigation.php');
require_once(THIS_SITE_PHP . 'html/section/DefaultSectionView.php');
require_once(THIS_SITE_PHP . 'html/ThisSiteHtmlHead.php');

//
$urlID = $_GET['id'];
$databaseApi = new DatabaseApi();
$currentSection = $databaseApi->getSectionWithUID($urlID);
$navigation = new DefaultNavigation($databaseApi->getSections(), $currentSection);
$view = ($currentSection->section_id != -1 && $currentSection->display_mode != 3)
    ? new DefaultSectionView($currentSection)
    : new Message('This section is invalid.');

$headTags = array('<title>' . htmlspecialchars($currentSection->html_title) . '</title>',
    '<meta name="description" content="' . htmlspecialchars($currentSection->html_description) . '"/>');

//
$htmlHead = new ThisSiteHtmlHead($headTags);
$htmlBody = new DefaultThisSiteHtmlBody($navigation, $view);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
