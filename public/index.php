<?php

require 'boot.php';

use thissite\db\ModelFactory;

$pageModel = ModelFactory::get('thissite\db\PageModel');
$page = $pageModel->getWithUID($_GET['id']);

if($page && $page['display_mode'] != 3) {
    $t_head = head($page);

    list($t_list_nav, $t_select_nav)
        = navs($pageModel->getPages(), $page['page_id']);

    if(preg_match('/\.php$/', $page['page_content'])) {
        include PAGE_ROUTES . $page['page_content'];
    }
    else {
        $t_content = IS_SAFE_MODE
            ? safe_mode($page['page_content'])
            : $page['page_content'];
    }
        
    include SRC . 'thissite/html/template.php';
}
else {
    header('HTTP/1.0 404 Not Found', true, 404);
    exit();
}
