<?php

require_once('./constants.php');
require_once(THIS_SITE . 'database/MyModelFactory.php');

$pageModel = MyModelFactory::getModel('PageModel');
$pageModel->install();

printf('Install successful. <a href="%s">Visit CMS</a>.', NEW_PAGE);

?>
