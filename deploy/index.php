<?php

require_once 'const.php';
require_once CITYPHP . '__autoload.php';
require_once THISSITE . 'html/navs.php';

use thissite\database\ModelFactory;

$pageModel = ModelFactory::get('thissite\database\PageModel');
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

    $content = $page['page_content'];
    include THISSITE . 'html/template.php';
}
else {
    header('HTTP/1.0 404 Not Found', true, 404);
    exit();
}

?>
