<?php

require_once('../constants.php');
require_once(CITYPHP . 'route.php');
require_once(THIS_SITE . 'database/MyModelFactory.php');
require_once(THIS_SITE . 'html/cmsNavItems.php');

$sectionModel = MyModelFactory::getModel('SectionModel');

include(route(array(
    null => 'new-section.php',
    'edit' => 'edit-section.php')));

$navItems = cmsNavItems($sectionModel->getSections(),
    $sectionID, $isNewSection);

include(THIS_SITE . 'html/template.php');

?>
