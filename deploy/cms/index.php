<?php

require '../const.php';
require '../vendor/autoload.php';

use thissite\db\ModelFactory;

$pageModel = ModelFactory::get('thissite\db\PageModel');

include '../src/thissite/routes/' . route(array(
    null => 'new-page.php',
    'edit' => 'edit-page.php'));

list($listNav, $selectNav)
    = cmsNavs($pageModel->getPages(), $pageID, $isNewPage);

include '../src/thissite/html/template.php';

?>
