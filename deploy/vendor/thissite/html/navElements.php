<?php

require_once THISSITE . 'html/currentLink.php';

function navElements($pages, $currentPageID, $baseURL, $key, $forceShow = false) {
    $listItems = array();
    $selectOptions = array();
    $selectedValue = null;

    foreach($pages as $page) {
        if($forceShow || $page['display_mode'] == 1) {
            $isCurrent = ($page['page_id'] == $currentPageID);
            $url = $baseURL . $page[$key];
            $listItems[] = sprintf('<a %shref="%s">%s</a>',
                currentLink($isCurrent), $url, $page['link_title']);

            $selectOptions[$url] = $page['link_title'];

            if($isCurrent) {
                $selectedValue = $url;
            }
        }
    }

    return array($listItems, $selectOptions, $selectedValue);
}

?>
