<?php

require_once('./constants.php');
require_once(CITY_PHP . 'html/HtmlDoc.php');
require_once(THIS_SITE_PHP . 'database/MyModelFactory.php');
require_once(THIS_SITE_PHP . 'html/Message.php');
require_once(THIS_SITE_PHP . 'html/navigation/SiteNavigation.php');
require_once(THIS_SITE_PHP . 'html/SectionView.php');
require_once(THIS_SITE_PHP . 'html/ThisSiteHtmlBody.php');
require_once(THIS_SITE_PHP . 'html/ThisSiteHtmlHead.php');

$urlID = $_GET['id'];
$sectionModel = MyModelFactory::getModel('SectionModel');
$currentSection = $sectionModel->getSectionWithUID($urlID);
$navigation = new SiteNavigation($sectionModel->getSections(), $currentSection);
$view = ($currentSection->section_id != -1 && $currentSection->display_mode != 3)
    ? new SectionView($currentSection)
    : new Message('This section is invalid.');

$headTags = array('<title>' . htmlspecialchars($currentSection->html_title) . '</title>',
    '<meta name="description" content="' . htmlspecialchars($currentSection->html_description) . '"/>');

$htmlHead = new ThisSiteHtmlHead($headTags);
$htmlBody = new ThisSiteHtmlBody($navigation, $view);
$htmlDoc = new HtmlDoc($htmlHead, $htmlBody);
print $htmlDoc->draw();

?>
