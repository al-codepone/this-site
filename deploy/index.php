<?php

require_once('./constants.php');
require_once(THIS_SITE . 'database/MyModelFactory.php');
require_once(THIS_SITE . 'html/navItems.php');

$sectionModel = MyModelFactory::getModel('SectionModel');
$section = $sectionModel->getSectionWithUID($_GET['id']);
$head = sprintf('<title>%s</title>'
    . '<meta name="description" content="%s"/>'
    . '<meta name="keywords" content="%s"/>',
    htmlspecialchars($section['html_title']),
    htmlspecialchars($section['html_description']),
    htmlspecialchars($section['html_keywords']));

$navItems = navItems($sectionModel->getSections(),
    $section['section_id'], ROOT, 'url_id');

$content = ($section && $section['display_mode'] != 3)
    ? str_replace("\r\n", '<br/>', $section['page_content'])
    : 'This section is invalid.';

include(THIS_SITE . 'html/template.php');

?>
