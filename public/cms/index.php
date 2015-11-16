<?php

require '../boot.php';

use thissite\db\ModelFactory;

$pageModel = ModelFactory::get('thissite\db\PageModel');

include SRC . 'thissite/routes/' . pc\route(array(
    null => 'new-page.php',
    'edit' => 'edit-page.php'));

list($listNav, $selectNav)
    = cmsNavs($pageModel->getPages(), $pageID, $isNewPage);

include SRC . 'thissite/html/template.php';
