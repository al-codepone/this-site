<?php

require_once('./constants.php');
require_once(THIS_SITE_PHP . 'database/MyModelFactory.php');
require_once(THIS_SITE_PHP . 'html/navItems.php');

$sectionModel = MyModelFactory::getModel('SectionModel');
$section = $sectionModel->getSectionWithUID($_GET['id']);
$head = sprintf('<title>%s</title>'
    . '<meta name="description" content="%s"/>',
    htmlspecialchars($section['html_title']),
    htmlspecialchars($section['html_description']));

$navItems = navItems($sectionModel->getSections(),
    $section['section_id'], ROOT, 'url_id');

$content = ($section && $section['display_mode'] != 3)
    ? str_replace("\r\n", '<br/>', $section['content'])
    : 'This section is invalid.';

include(THIS_SITE_PHP . 'html/template.php');

?>
