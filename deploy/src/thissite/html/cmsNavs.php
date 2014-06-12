<?php

function cmsNavs($pages, $currentPageID, $isNewPage) {
    list($listItems, $selectOptions, $selectedValue)
        = navElements($pages, $currentPageID, EDIT_PAGE, 'page_id', true);

    $newPageLink = sprintf('<a %shref="%s">%s</a>',
        currentLink($isNewPage),
        NEW_PAGE,
        NEW_PAGE_TITLE);

    $listItems = array_merge(
        array($newPageLink => array('id' => 'new_page')),
        $listItems);

    $selectOptions = array_merge(
        array(NEW_PAGE => NEW_PAGE_TITLE),
        $selectOptions);

    if($isNewPage) {
        $selectedValue = NEW_PAGE;
    }

    return array(
        c\ulist($listItems),
        c\drop_down(
            $selectOptions,
            array('onchange' => 'pageSelected(this);'),
            $selectedValue));
}
