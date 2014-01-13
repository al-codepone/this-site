<?php

function navs($pages, $currentPageID) {
    list($listItems, $selectOptions, $selectedValue)
        = navElements($pages, $currentPageID, ROOT, 'url_id');

    return array(
        blist($listItems),
        select($selectOptions, array('onchange' => 'pageSelected(this);'),
            '', $selectedValue, false));
}

?>
