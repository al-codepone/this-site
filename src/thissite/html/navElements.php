<?php

function navElements($pages, $currentPageID, $baseURL, $key, $forceShow = false) {
    $listItems = array();
    $selectOptions = array();
    $selectedValue = null;

    foreach($pages as $page) {
        $isCurrent = ($page['page_id'] == $currentPageID);
        $url = $baseURL . $page[$key];

        if($forceShow || $page['display_mode'] == 1) {
            $listItems[] = c\a(
                array_merge(
                    currentLink($isCurrent),
                    array('href' => $url)),
                $page['link_title']);

            $selectOptions[$url] = $page['link_title'];

            if($isCurrent) {
                $selectedValue = $url;
            }
        }

        if($isCurrent) {
            $currentTitle = $page['link_title'];
            $currentURL = $url;
        }
    }

    if(is_null($selectedValue) && !is_null($currentTitle)) {
        $selectOptions[$currentURL] = $currentTitle;
        $selectedValue = $currentURL;
    }

    return array($listItems, $selectOptions, $selectedValue);
}
