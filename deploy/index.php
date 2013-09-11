<?php

require_once 'constants.php';
require_once CITYPHP . '__autoload.php';
require_once THISSITE . 'html/navItems.php';

use thissite\database\ModelFactory;

$pageModel = ModelFactory::get('thissite\database\PageModel');
$page = $pageModel->getPageWithUID($_GET['id']);
$head = sprintf('<title>%s</title>
    <meta name="description" content="%s"/>
    <meta name="keywords" content="%s"/>',
    htmlspecialchars($page['html_title']),
    htmlspecialchars($page['html_description']),
    htmlspecialchars($page['html_keywords']));

$navItems = navItems($pageModel->getPages(),
    $page['page_id'], ROOT, 'url_id');

$content = ($page && $page['display_mode'] != 3)
    ? $page['page_content']
    : 'This page is invalid.';

include THISSITE . 'html/template.php';

?>
