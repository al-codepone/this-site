<?php

require_once CITYPHP . 'html/select.php';
require_once CITYPHP . 'html/ulist.php';
require_once THISSITE . 'html/currentLink.php';
require_once THISSITE . 'html/navElements.php';

function cmsNavs($pages, $currentPageID, $isNewPage) {
    list($listItems, $selectOptions, $selectedValue)
        = navElements($pages, $currentPageID, EDIT_PAGE, 'page_id', true);

    array_unshift($listItems,
        sprintf('<a %shref="%s">%s</a>',
            currentLink($isNewPage),
            NEW_PAGE,
            NEW_PAGE_TITLE));

    $selectOptions = array_merge(
        array(NEW_PAGE => NEW_PAGE_TITLE),
        $selectOptions);

    if($isNewPage) {
        $selectedValue = NEW_PAGE;
    }

    return array(
        ulist($listItems),
        select($selectOptions, array('onchange' => 'pageSelected(this);'),
            '', $selectedValue, false));
}

?>
