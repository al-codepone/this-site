<?php

require 'boot.php';

use thissite\db\ModelFactory;

$page_model = ModelFactory::get('thissite\db\PageModel');
$page = $page_model->getWithUID($_GET['id']);

if($page && $page['display_mode'] != 3) {
    $t_head = head($page);

    list($t_list_nav, $t_select_nav)
        = navs($page_model->getPages(), $page['page_id']);

    if(preg_match('/\.php$/', $page['page_content'])) {
        include PAGE_ROUTES . $page['page_content'];
    }
    else {
        $t_content = IS_SAFE_MODE
            ? safe_mode($page['page_content'])
            : $page['page_content'];
    }

    //
    if($t_select_nav !== '') {
        $t_head .= c\js(JS . 'all.js');
        $t_last .= avoid_select_nav_cache($_GET['id']);
    }

    //
    $t_logos = logos();

    //
    include SRC . 'thissite/html/template.php';
}
else {
    header('HTTP/1.0 404 Not Found', true, 404);
    exit();
}
