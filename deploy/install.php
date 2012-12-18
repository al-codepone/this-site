<?php

require_once('./constants.php');
require_once(THIS_SITE . 'database/ModelFactory.php');

$pageModel = ModelFactory::get('PageModel');
$pageModel->install();

printf('Install successful. <a href="%s">Visit CMS</a>.', NEW_PAGE);

?>
