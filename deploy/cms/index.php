<?php

require_once '../const.php';
require_once CITYPHP . '__autoload.php';
require_once CITYPHP . 'route.php';
require_once THISSITE . 'html/cmsNavs.php';

use thissite\db\ModelFactory;

$pageModel = ModelFactory::get('thissite\db\PageModel');

include THISSITE . 'routes/' . route(array(
    null => 'new-page.php',
    'edit' => 'edit-page.php'));

list($listNav, $selectNav)
    = cmsNavs($pageModel->getPages(), $pageID, $isNewPage);

include THISSITE . 'html/template.php';

?>
