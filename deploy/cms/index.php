<?php

require_once('../constants.php');
require_once(CITYPHP . 'route.php');
require_once(THIS_SITE . 'database/ModelFactory.php');
require_once(THIS_SITE . 'html/cmsNavItems.php');

$pageModel = ModelFactory::get('PageModel');

include(route(array(
    null => 'new-page.php',
    'edit' => 'edit-page.php')));

$navItems = cmsNavItems($pageModel->getPages(),
    $pageID, $isNewPage);

include(THIS_SITE . 'html/template.php');

?>
