<?php

require_once('../constants.php');
require_once(CITYPHP . 'route.php');
require_once(THIS_SITE_PHP . 'database/MyModelFactory.php');
require_once(THIS_SITE_PHP . 'html/cmsNavItems.php');
require_once(THIS_SITE_PHP . 'html/urlDupError.php');

$sectionModel = MyModelFactory::getModel('SectionModel');

include(route(array(
    null => 'new_section.php',
    'edit' => 'edit_section.php')));

$navItems = cmsNavItems($sectionModel->getSections(),
    $sectionID, $isNewSection);

include(THIS_SITE_PHP . 'html/template.php');

?>
