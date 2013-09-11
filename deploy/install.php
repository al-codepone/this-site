<?php

require_once 'constants.php';
require_once CITYPHP . '__autoload.php';

use thissite\database\ModelFactory;

$pageModel = ModelFactory::get('thissite\database\PageModel');
$pageModel->install();

printf('Install successful. <a href="%s">Visit CMS</a>.', NEW_PAGE);

?>
