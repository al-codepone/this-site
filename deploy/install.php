<?php

require_once('./constants.php');
require_once(THIS_SITE_PHP . 'database/MyModelFactory.php');

$sectionModel = MyModelFactory::getModel('SectionModel');
$sectionModel->install();

printf('Install successful. <a href="%s">Visit CMS</a>.', NEW_SECTION);

?>
