<?php

require '../boot.php';

use thissite\db\ModelFactory;

$page_model = ModelFactory::get('thissite\db\PageModel');

include SRC . 'thissite/routes/' . pc\route(array(
    null => 'new-page.php',
    'edit' => 'edit-page.php'));

list($t_list_nav, $t_select_nav)
    = cmsNavs($page_model->getPages(), $pageID, $isNewPage);

include SRC . 'thissite/html/template.php';
