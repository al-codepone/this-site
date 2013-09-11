<?php

require_once '../constants.php';
require_once CITYPHP . '__autoload.php';
require_once CITYPHP . 'route.php';
require_once THISSITE . 'html/cmsNavItems.php';

use thissite\database\ModelFactory;

$pageModel = ModelFactory::get('thissite\database\PageModel');

include route(array(
    null => 'new-page.php',
    'edit' => 'edit-page.php'),
    THISSITE . 'routes/');

$navItems = cmsNavItems($pageModel->getPages(),
    $pageID, $isNewPage);

include THISSITE . 'html/template.php';

?>
