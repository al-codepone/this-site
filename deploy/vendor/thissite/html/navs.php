<?php

require_once CITYPHP . 'html/select.php';
require_once CITYPHP . 'html/ulist.php';
require_once THISSITE . 'html/navElements.php';

function navs($pages, $currentPageID) {
    list($listItems, $selectOptions, $selectedValue)
        = navElements($pages, $currentPageID, ROOT, 'url_id');

    return array(
        ulist($listItems),
        select($selectOptions, array('onchange' => 'pageSelected(this);'),
            '', $selectedValue, false));
}

?>
