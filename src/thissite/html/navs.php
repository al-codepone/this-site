<?php

function navs($pages, $currentPageID) {
    list($listItems, $selectOptions, $selectedValue)
        = navElements($pages, $currentPageID, ROOT, 'url_id');

    return array(
        c\ulist($listItems),
        c\drop_down(
            $selectOptions,
            array('onchange' => 'pageSelected(this);'),
            $selectedValue));
}
