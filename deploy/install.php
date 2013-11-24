<?php

require_once 'const.php';
require_once CITYPHP . '__autoload.php';

use thissite\db\ModelFactory;

$pageModel = ModelFactory::get('thissite\db\PageModel');
$pageModel->install();

printf('Install successful. <a href="%s">Visit CMS</a>.', NEW_PAGE);

?>
