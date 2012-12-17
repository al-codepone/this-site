<?php

require_once(THIS_SITE . 'html/currentLink.php');
require_once(THIS_SITE . 'html/navItems.php');

function cmsNavItems($pages, $currentPageID, $isNewPage) {
    return sprintf('<span id="new_page"><a %shref="%s">%s</a></span>%s',
        currentLink($isNewPage),
        NEW_PAGE,
        NEW_PAGE_TITLE,
        navItems($pages,
            $currentPageID,
            EDIT_PAGE,
            'page_id',
            true));
}

?>
