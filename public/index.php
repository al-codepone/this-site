<?php

require 'boot.php';

use thissite\db\ModelFactory;

$pageModel = ModelFactory::get('thissite\db\PageModel');
$page = $pageModel->getPageWithUID($_GET['id']);

if($page && $page['display_mode'] != 3) {
    $head = sprintf('<title>%s</title>
        <meta name="description" content="%s"/>
        <meta name="keywords" content="%s"/>',
        htmlspecialchars($page['html_title']),
        htmlspecialchars($page['html_description']),
        htmlspecialchars($page['html_keywords']));

    list($listNav, $selectNav)
        = navs($pageModel->getPages(), $page['page_id']);

    $content = IS_SAFE_MODE
        ? safeMode($page['page_content'])
        : $page['page_content'];
        
    include SRC . 'thissite/html/template.php';
}
else {
    header('HTTP/1.0 404 Not Found', true, 404);
    exit();
}
