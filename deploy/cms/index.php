<?php

require_once('../constants.php');
require_once(CITY_PHP . 'functions.php');
require_once(THIS_SITE_PHP . 'database/MyModelFactory.php');
require_once(THIS_SITE_PHP . 'html/cmsNavItems.php');

$sectionModel = MyModelFactory::getModel('SectionModel');
$head = '';

include(getRoute(array(
    NULL => 'new_section.php',
    'edit' => 'edit_section.php')));

$navItems = cmsNavItems($sectionModel->getSections());
include(THIS_SITE_PHP . 'html/template.php');

?>
